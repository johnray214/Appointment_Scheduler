<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" data-needs-pusher="false" x-data="{ open: false, mobileMenuOpen: false }">
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-gradient-to-r from-orange-600 to-orange-500 shadow-lg border-b border-orange-400">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('provider.dashboard') }}" class="flex items-center gap-2 text-2xl font-bold text-white hover:text-orange-100 transition-colors duration-200">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-6 sm:-my-px sm:ml-10 sm:flex items-center">
                            <a href="{{ route('provider.dashboard') }}" class="flex items-center gap-2 px-3 py-2 text-white hover:text-orange-100 rounded-lg transition-all duration-200 {{ request()->routeIs('provider.dashboard') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0v6m0 0H7m6 0h6" /></svg>
                                Dashboard
                            </a>
                            <a href="{{ route('provider.appointments.index') }}" class="flex items-center gap-2 px-3 py-2 text-white hover:text-orange-100 rounded-lg transition-all duration-200 {{ request()->routeIs('provider.appointments.*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                Appointments
                            </a>
                            <a href="{{ route('provider.services.index') }}" class="flex items-center gap-2 px-3 py-2 text-white hover:text-orange-100 rounded-lg transition-all duration-200 {{ request()->routeIs('provider.services.*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 21m6-4l.75 4M4 7h16M4 11h16M4 15h16" /></svg>
                                Services
                            </a>
                            <a href="{{ route('provider.business_hours.edit') }}" class="flex items-center gap-2 px-3 py-2 text-white hover:text-orange-100 rounded-lg transition-all duration-200 {{ request()->routeIs('provider.business_hours.*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Business Hours
                            </a>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ml-1">
                                        <svg :class="{'transform rotate-180': open}" class="fill-current h-4 w-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </button>

                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                <div class="py-1">
                                    <x-dropdown-link :href="route('provider.business-profile.edit')">
                                        {{ __('Business Profile') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('provider.profile.edit')">
                                        {{ __('Account Settings') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                @click.prevent="$el.closest('form').submit()">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" aria-expanded="false" aria-controls="mobile-menu">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path class="mobile-menu-icon menu-open-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path class="mobile-menu-icon menu-close-icon hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div id="mobile-menu" class="hidden sm:hidden bg-orange-500 border-t border-orange-400 shadow-lg">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('provider.dashboard')" :active="request()->routeIs('provider.dashboard')" class="text-white hover:bg-orange-600 hover:text-white transition-colors duration-200">
                        Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('provider.appointments.index')" :active="request()->routeIs('provider.appointments.*')">
                        Appointments
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('provider.services.index')" :active="request()->routeIs('provider.services.*')">
                        Services
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('provider.business_hours.edit')" :active="request()->routeIs('provider.business_hours.*')">
                        Business Hours
                    </x-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Navigation and UI Scripts -->
    <script>
    // Function to initialize charts
    function initializeCharts() {
        if (typeof window.chartInitialized === 'undefined') {
            window.chartInitialized = true;
            
            // Check if there's a chart initialization function
            if (typeof window.initializeChartFunctions === 'function') {
                window.initializeChartFunctions();
            }
        }
    }
    
    // Initialize when DOM is loaded and Chart.js is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuOpenIcons = document.querySelectorAll('.menu-open-icon');
        const menuCloseIcons = document.querySelectorAll('.menu-close-icon');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function(e) {
                e.stopPropagation();
                const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
                
                // Toggle menu visibility
                mobileMenu.classList.toggle('hidden');
                
                // Update button state
                mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
                
                // Toggle menu icons
                menuOpenIcons.forEach(icon => icon.classList.toggle('hidden', !isExpanded));
                menuCloseIcons.forEach(icon => icon.classList.toggle('hidden', isExpanded));
            });
            
            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && 
                    !mobileMenuButton.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                    menuOpenIcons.forEach(icon => icon.classList.remove('hidden'));
                    menuCloseIcons.forEach(icon => icon.classList.add('hidden'));
                }
            });
        }
        
        // Close mobile menu when a nav link is clicked
        const navLinks = document.querySelectorAll('#mobile-menu a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
                menuOpenIcons.forEach(icon => icon.classList.remove('hidden'));
                menuCloseIcons.forEach(icon => icon.classList.add('hidden'));
            });
        });
    });
    </script>
    
    <!-- Chart.js with error handling -->
    <script>
    // Initialize charts when Chart.js is ready
    if (typeof Chart !== 'undefined') {
        console.log('Chart.js is already loaded, initializing charts...');
        initializeCharts();
    } else {
        console.log('Waiting for Chart.js to load...');
        
        // Fallback in case the script is loaded asynchronously
        const checkChart = setInterval(function() {
            if (typeof Chart !== 'undefined') {
                clearInterval(checkChart);
                console.log('Chart.js loaded, initializing charts...');
                initializeCharts();
            }
        }, 100);
        
        // Set a timeout in case Chart.js fails to load
        setTimeout(function() {
            if (typeof Chart === 'undefined') {
                console.error('Chart.js failed to load after timeout');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative';
                errorDiv.role = 'alert';
                errorDiv.innerHTML = `
                    <strong class="font-bold">Chart Error</strong>
                    <span class="block sm:inline">Failed to load chart library. Please refresh the page or contact support if the issue persists.</span>
                `;
                document.body.prepend(errorDiv);
            }
        }, 5000);
    }
    </script>
    
    @yield('scripts')
    @stack('scripts')
    
    <!-- Debug information -->
    <script>
        console.log('Document ready, libraries state:', {
            Chart: typeof Chart !== 'undefined' ? 'loaded' : 'not loaded',
            ChartDataLabels: typeof ChartDataLabels !== 'undefined' ? 'loaded' : 'not loaded'
        });
    </script>

    <!-- Add hover underline effect to nav links -->
    <style>
        .group:hover .group-hover\:text-white {
            color: #fff !important;
        }
        .group:hover {
            border-bottom: 2px solid #fff;
        }
    </style>
</body>
</html>
