 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page.title', config('app.name'))</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.8/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Подключение стилей и скриптов через Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Theme initialization script (must be in head to prevent flash) -->
    <script>
        (function() {
            const getStoredTheme = () => localStorage.getItem('theme') || 'dark';
            const theme = getStoredTheme();
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>
    
    @stack('css')

</head>
<body>
    <div class="d-flex flex-column justify-content-between min-vh-100">
        @include('includes.alert')
        @include('includes.header')

        <main class="flex-grow-1">
                @yield('content')
        </main>

        @include('includes.footer')
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.8/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Theme switcher functionality
        (function() {
            'use strict';
            
            // Get stored theme or default to 'dark'
            const getStoredTheme = () => localStorage.getItem('theme') || 'dark';
            const setStoredTheme = theme => localStorage.setItem('theme', theme);
            
            const getPreferredTheme = () => {
                const storedTheme = getStoredTheme();
                if (storedTheme) {
                    return storedTheme;
                }
                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            };
            
            const setTheme = theme => {
                document.documentElement.setAttribute('data-bs-theme', theme);
                document.body.setAttribute('data-bs-theme', theme);
                updateThemeIcon(theme);
            };
            
            const updateThemeIcon = theme => {
                const lightIcon = document.getElementById('theme-icon-light');
                const darkIcon = document.getElementById('theme-icon-dark');
                
                if (lightIcon && darkIcon) {
                    if (theme === 'dark') {
                        lightIcon.classList.add('d-none');
                        darkIcon.classList.remove('d-none');
                    } else {
                        lightIcon.classList.remove('d-none');
                        darkIcon.classList.add('d-none');
                    }
                }
            };
            
            // Set theme on page load
            setTheme(getPreferredTheme());
            
            // Theme toggle button click handler
            window.addEventListener('DOMContentLoaded', () => {
                const toggleButton = document.getElementById('theme-toggle');
                
                if (toggleButton) {
                    toggleButton.addEventListener('click', () => {
                        const currentTheme = document.documentElement.getAttribute('data-bs-theme');
                        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                        setStoredTheme(newTheme);
                        setTheme(newTheme);
                    });
                }
            });
            
            // Listen for system theme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const storedTheme = getStoredTheme();
                if (!storedTheme) {
                    setTheme(getPreferredTheme());
                }
            });
        })();
    </script>
    
    @stack('js')
</body>
</html>