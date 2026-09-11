<script>
    (function () {
        'use strict';

        function initPostStagger(root) {
            const track = root.querySelector('.post-stagger__track');
            const order = Array.from(root.querySelectorAll('.post-stagger__card'));
            const prevBtn = root.querySelector('[data-stagger-prev]');
            const nextBtn = root.querySelector('[data-stagger-next]');

            if (!track || order.length === 0) {
                return;
            }

            function cardSize() {
                return window.matchMedia('(min-width: 640px)').matches ? 365 : 290;
            }

            function render() {
                const size = cardSize();
                const total = order.length;

                order.forEach((card, index) => {
                    const position = total % 2
                        ? index - Math.floor((total + 1) / 2)
                        : index - Math.floor(total / 2);
                    const isCenter = position === 0;

                    card.classList.toggle('is-center', isCenter);
                    card.style.width = size + 'px';
                    card.style.height = size + 'px';
                    // Stack cards by distance from the center instead of a flat
                    // 0/10 split, so a card sliding past another never flickers
                    // underneath it mid-transition.
                    card.style.zIndex = String(total - Math.abs(position));

                    const translateY = isCenter ? -65 : (position % 2 !== 0 ? 15 : -15);
                    const rotate = isCenter ? 0 : (position % 2 !== 0 ? 2.5 : -2.5);

                    card.style.transform =
                        'translate(-50%, -50%) ' +
                        'translateX(' + ((size / 1.5) * position) + 'px) ' +
                        'translateY(' + translateY + 'px) ' +
                        'rotate(' + rotate + 'deg)';

                    card.dataset.position = position;
                });
            }

            function move(steps) {
                steps = Math.trunc(steps);
                if (steps === 0) {
                    return;
                }

                // Rotating the order shifts every card by `steps` slots except
                // for the ones that wrap from one end of the list to the
                // other - those would otherwise sweep all the way across the
                // carousel as their transform transitions between two far-out
                // positions. Snap those specific cards into place instantly.
                const wrapped = steps > 0
                    ? order.slice(0, steps)
                    : order.slice(order.length + steps);

                wrapped.forEach((card) => {
                    card.style.transitionDuration = '0s';
                });

                if (steps > 0) {
                    for (let i = 0; i < steps; i++) {
                        order.push(order.shift());
                    }
                } else {
                    for (let i = 0; i < -steps; i++) {
                        order.unshift(order.pop());
                    }
                }
                render();

                requestAnimationFrame(() => {
                    wrapped.forEach((card) => {
                        card.style.transitionDuration = '';
                    });
                });
            }

            function activate(card) {
                const position = parseInt(card.dataset.position, 10) || 0;
                if (position === 0) {
                    const url = card.dataset.url;
                    if (url) {
                        window.location.href = url;
                    }
                } else {
                    move(position);
                }
            }

            let justSwiped = false;

            order.forEach((card) => {
                card.addEventListener('click', (event) => {
                    if (justSwiped) {
                        justSwiped = false;
                        event.preventDefault();
                        return;
                    }
                    activate(card);
                });
                card.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        activate(card);
                    }
                });
            });

            if (prevBtn) {
                prevBtn.addEventListener('click', () => move(-1));
            }
            if (nextBtn) {
                nextBtn.addEventListener('click', () => move(1));
            }

            // Swipe support (touch devices, mainly mobile).
            const SWIPE_THRESHOLD = 40;
            let touchStartX = null;
            let touchStartY = null;
            let touchIsHorizontal = false;

            root.addEventListener('touchstart', (event) => {
                if (event.touches.length !== 1) {
                    return;
                }
                touchStartX = event.touches[0].clientX;
                touchStartY = event.touches[0].clientY;
                touchIsHorizontal = false;
            }, { passive: true });

            root.addEventListener('touchmove', (event) => {
                if (touchStartX === null || event.touches.length !== 1) {
                    return;
                }
                const dx = event.touches[0].clientX - touchStartX;
                const dy = event.touches[0].clientY - touchStartY;
                if (!touchIsHorizontal && Math.abs(dx) > 10 && Math.abs(dx) > Math.abs(dy)) {
                    touchIsHorizontal = true;
                }
                if (touchIsHorizontal && event.cancelable) {
                    // Stop the page from scrolling while swiping the carousel horizontally.
                    event.preventDefault();
                }
            }, { passive: false });

            root.addEventListener('touchend', (event) => {
                if (touchStartX === null) {
                    return;
                }
                const touch = event.changedTouches && event.changedTouches[0];
                const dx = touch ? touch.clientX - touchStartX : 0;

                if (touchIsHorizontal && Math.abs(dx) >= SWIPE_THRESHOLD) {
                    justSwiped = true;
                    move(dx < 0 ? 1 : -1);
                }

                touchStartX = null;
                touchStartY = null;
                touchIsHorizontal = false;
            });

            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(render, 100);
            });

            render();
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-post-stagger]').forEach(initPostStagger);
        });
    })();
</script>
