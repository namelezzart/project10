<style>
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
        min-height: 250px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3) !important;
    }
    
    .card-title a {
        color: inherit;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.4;
        min-height: 2.8em;
    }
    
    .card-title a:hover {
        color: #0d6efd;
    }
    
    .card-text p {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
        min-height: 4.5em;
    }
    
    .stretched-link::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        content: "";
    }
</style>
