<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Appointment Scheduler') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            html, body {
                height: 100%;
            }
            body {
                min-height: 100vh;
                background: #fff;
            }
            .split-container {
                display: flex;
                width: 100%;
                max-width: 1000px;
                height: 540px;
                min-height: 400px;
                margin: auto;
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                box-shadow: 0 8px 32px 0 rgba(255, 87, 34, 0.10), 0 1.5px 8px 0 rgba(0,0,0,0.08);
                overflow: hidden;
            }
            .split-side {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            #branding-side {
                width: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            #form-side {
                width: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: white;
                padding: 2rem;
            }
            .split-bg {
                background: linear-gradient(135deg, #ff9800 0%, #ff5722 100%);
            }
            .split-card {
                width: 100%;
                max-width: 400px;
                background: #fff;
                border-radius: 0.5rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                padding: 2.5rem 2rem;
                max-height: 90vh;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: thin;
                scrollbar-color: rgba(255, 87, 34, 0.5) transparent;
            }
            .split-card::-webkit-scrollbar {
                width: 6px;
            }
            .split-card::-webkit-scrollbar-track {
                background: transparent;
            }
            .split-card::-webkit-scrollbar-thumb {
                background-color: rgba(255, 87, 34, 0.5);
                border-radius: 3px;
            }
            .split-card.left {
                border-radius: 0;
            }
            .split-logo {
                filter: drop-shadow(0 2px 8px rgba(255, 152, 0, 0.15));
            }
            @media (max-width: 900px) {
                .split-container {
                    flex-direction: column;
                    height: auto;
                    min-height: 100vh;
                    max-width: 100vw;
                    position: static;
                }
                .split-side { width: 100% !important; min-height: 200px; }
                .split-card, .split-card.left { border-radius: 0; max-width: 100vw; }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div id="guest-layout" class="split-container">
            <!-- Branding Side -->
            <div id="branding-side" class="split-side split-bg">
                <div class="flex flex-col items-center justify-center w-full">
                    <svg class="h-20 w-20 text-white split-logo mb-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" fill="currentColor"/>
                        <path d="M12 6C8.69 6 6 8.69 6 12C6 15.31 8.69 18 12 18C15.31 18 18 15.31 18 12C18 8.69 15.31 6 12 6ZM12 16C9.79 16 8 14.21 8 12C8 9.79 9.79 8 12 8C14.21 8 16 9.79 16 12C16 14.21 14.21 16 12 16Z" fill="currentColor"/>
                        <path d="M12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"/>
                    </svg>
                    <span class="text-3xl font-extrabold text-white tracking-wide drop-shadow font-bold">Appointment Scheduler</span>
                </div>
            </div>
            <!-- Form Side -->
            <div id="form-side" class="split-side bg-white flex flex-col justify-center items-center p-4">
    <div class="w-full max-w-md mb-4">
        <div id="login-link" class="text-left" style="display: none;">
            <a href="{{ route('login') }}" class="text-orange-600 hover:text-orange-800 font-semibold transition">&larr; Back to Login</a>
        </div>
        <div id="register-link" class="text-left">
            <a href="{{ route('register') }}" class="text-orange-600 hover:text-orange-800 font-semibold transition">Register &rarr;</a>
        </div>
    </div>

    <div class="split-card w-full max-w-md">
        {{ $slot }}
    </div>
</div>

        </div>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            let isRegister = window.location.pathname.includes('register');
            const brandingSide = document.getElementById('branding-side');
            const formSide = document.getElementById('form-side');
            const loginLink = document.getElementById('login-link');
            const registerLink = document.getElementById('register-link');
            
            // Initialize the layout based on the current route
            function updateLayout() {
                if (isRegister) {
                    brandingSide.classList.add('order-1');
                    brandingSide.classList.remove('order-2');
                    formSide.classList.add('order-2', 'split-card');
                    formSide.classList.remove('order-1', 'split-card', 'left');
                    loginLink.style.display = 'block';
                    registerLink.style.display = 'none';
                } else {
                    brandingSide.classList.add('order-2');
                    brandingSide.classList.remove('order-1');
                    formSide.classList.add('order-1', 'split-card', 'left');
                    formSide.classList.remove('order-2', 'split-card');
                    loginLink.style.display = 'none';
                    registerLink.style.display = 'block';
                }
            }
            
            // Initialize the layout
            updateLayout();
            
            // Handle back/forward browser navigation
            window.addEventListener('popstate', function() {
                isRegister = window.location.pathname.includes('register');
                updateLayout();
            });
        });
        </script>
    </body>
</html>
