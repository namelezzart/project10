<nav class="navbar navbar-expand-md navbar-modern">
  <div class="container">
    <a href="{{ route('home') }}" class="navbar-brand brand-modern">
        <i class="bi bi-stars me-2"></i>
        {{ config('app.name') }}
    </a>

    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
                <a href="{{ route('home')  }}" class="nav-link nav-link-modern {{ active_link('home') }}" aria-current="page">
                    <i class="bi bi-house-door me-1"></i>
                    {{ __('Home') }}
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('blog')  }}" class="nav-link nav-link-modern {{ active_link('blog*') }}" aria-current="page">
                    <i class="bi bi-journal-text me-1"></i>
                    {{ __('Blog') }}
                </a>
            </li>

            @auth
            <li class="nav-item">
                <a href="{{ route('user.posts')  }}" class="nav-link nav-link-modern {{ active_link('user.posts*') }}" aria-current="page">
                    <i class="bi bi-file-earmark-text me-1"></i>
                    {{ __('My Posts') }}
                </a>
            </li>
            @endauth
        </ul>

        <ul class="navbar-nav ms-auto mb-2 mb-md-0 align-items-center">
            <!-- Theme Switcher -->
            <li class="nav-item me-2">
                <button class="btn btn-link nav-link" id="theme-toggle" aria-label="Toggle theme">
                    <i class="bi bi-sun-fill" id="theme-icon-light"></i>
                    <i class="bi bi-moon-stars-fill d-none" id="theme-icon-dark"></i>
                </button>
            </li>
            
            @guest
                <li class="nav-item">
                    <a href="{{ route('register')  }}" class="nav-link nav-link-modern {{ active_link('register') }}" aria-current="page">
                        <i class="bi bi-person-plus me-1"></i>
                        {{ __('Sign up') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('login')  }}" class="btn btn-primary btn-sm ms-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        {{ __('Log in') }}
                    </a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link-modern d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar me-2">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-modern">
                        <li>
                            <a class="dropdown-item" href="{{ route('user.posts') }}">
                                <i class="bi bi-file-earmark-text me-2"></i>
                                {{ __('My Posts') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
    </div>
  </div>
</nav>
