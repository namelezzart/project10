<footer class="footer-modern">
    <div class="container">
        <div class="row py-4">
            <!-- Левая колонка -->
            <div class="col-md-4 mb-3 mb-md-0">
                <h5 class="footer-brand">
                    <i class="bi bi-stars me-2"></i>
                    {{ config('app.name') }}
                </h5>
                <p class="text-muted small">
                    Modern blog platform with beautiful design and powerful features.
                </p>
            </div>
            
            <!-- Центральная колонка -->
            <div class="col-md-4 mb-3 mb-md-0">
                <h6 class="footer-heading">Quick Links</h6>
                <ul class="list-unstyled footer-links">
                    <li>
                        <a href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog') }}">
                            <i class="bi bi-journal-text me-1"></i>
                            Blog
                        </a>
                    </li>
                    @auth
                    <li>
                        <a href="{{ route('user.posts') }}">
                            <i class="bi bi-file-earmark-text me-1"></i>
                            My Posts
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
            
            <!-- Правая колонка -->
            <div class="col-md-4">
                <h6 class="footer-heading">Connect</h6>
                <div class="social-links">
                    <a href="#" class="social-link" aria-label="GitHub">
                        <i class="bi bi-github"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Email">
                        <i class="bi bi-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="footer-bottom">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0 text-muted small">
                        © {{ $date }} {{ config('app.name') }}. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>