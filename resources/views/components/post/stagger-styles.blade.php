<style>
    .post-stagger {
        position: relative;
        width: 100%;
        overflow: hidden;
        height: 600px;
        border-radius: 0.75rem;
        background: var(--bs-tertiary-bg, var(--bs-secondary-bg));
        margin-bottom: 2rem;
    }

    @media (max-width: 639.98px) {
        .post-stagger {
            height: 500px;
        }
    }

    .post-stagger__track {
        position: absolute;
        inset: 0;
    }

    .post-stagger__card {
        position: absolute;
        left: 50%;
        top: 50%;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        padding: 2rem;
        border: 2px solid var(--bs-border-color);
        background: var(--bs-body-bg);
        color: var(--bs-body-color);
        transition: transform 0.5s ease-in-out, border-color 0.3s ease, background-color 0.3s ease, color 0.3s ease;
        clip-path: polygon(50px 0%, calc(100% - 50px) 0%, 100% 50px, 100% 100%, calc(100% - 50px) 100%, 50px 100%, 0 100%, 0 0);
        z-index: 0;
        outline: none;
    }

    .post-stagger__card:hover {
        border-color: rgba(var(--bs-primary-rgb), 0.5);
    }

    .post-stagger__card.is-center {
        z-index: 10;
        background: var(--bs-primary);
        border-color: var(--bs-primary);
        color: #fff;
        box-shadow: 0px 8px 0px 4px var(--bs-border-color);
    }

    .post-stagger__card:focus-visible {
        outline: 2px solid var(--bs-primary);
        outline-offset: 2px;
    }

    .post-stagger__corner-line {
        position: absolute;
        display: block;
        right: -2px;
        top: 48px;
        width: 70.71px;
        height: 2px;
        background: var(--bs-border-color);
        transform-origin: top right;
        transform: rotate(45deg);
    }

    .post-stagger__card.is-center .post-stagger__corner-line {
        background: rgba(255, 255, 255, 0.5);
    }

    .post-stagger__icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 3rem;
        height: 3.5rem;
        margin-bottom: 1rem;
        font-size: 1.5rem;
        background: var(--bs-secondary-bg);
        color: var(--bs-body-color);
        box-shadow: 3px 3px 0px var(--bs-body-bg);
    }

    .post-stagger__card.is-center .post-stagger__icon {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
    }

    .post-stagger__title {
        font-size: 1.05rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-stagger__excerpt {
        font-size: 0.875rem;
        opacity: 0.85;
        margin-bottom: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-stagger__meta {
        position: absolute;
        left: 2rem;
        right: 2rem;
        bottom: 1.75rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem 0.9rem;
        font-size: 0.75rem;
        font-style: italic;
        opacity: 0.8;
    }

    .post-stagger__meta-item i {
        margin-right: 0.2rem;
    }

    .post-stagger__controls {
        position: absolute;
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 0.5rem;
        z-index: 20;
    }

    .post-stagger__btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 3.25rem;
        height: 3.25rem;
        font-size: 1.25rem;
        background: var(--bs-body-bg);
        color: var(--bs-body-color);
        border: 2px solid var(--bs-border-color);
        border-radius: 0;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .post-stagger__btn:hover {
        background: var(--bs-primary);
        color: #fff;
        border-color: var(--bs-primary);
    }

    .post-stagger__btn:focus-visible {
        outline: 2px solid var(--bs-primary);
        outline-offset: 2px;
    }
</style>
