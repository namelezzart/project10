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
                    card.style.zIndex = isCenter ? '10' : '0';

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

            order.forEach((card) => {
                card.addEventListener('click', () => activate(card));
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
