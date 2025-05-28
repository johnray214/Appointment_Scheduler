<nav class="bg-orange-600 shadow-lg border-b-4 border-orange-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-6">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <svg class="h-10 w-10 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" fill="currentColor" />
                        <path d="M12 6C8.69 6 6 8.69 6 12C6 15.31 8.69 18 12 18C15.31 18 18 15.31 18 12C18 8.69 15.31 6 12 6ZM12 16C9.79 16 8 14.21 8 12C8 9.79 9.79 8 12 8C14.21 8 16 9.79 16 12C16 14.21 14.21 16 12 16Z" fill="currentColor" />
                        <path d="M12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor" />
                    </svg>
                    <span class="ml-2 text-2xl font-extrabold text-white tracking-wide">Appointment Scheduler</span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                    @if(auth()->user()->role === 'client')
                    <x-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')" class="text-white font-semibold hover:text-orange-200 transition">{{ __('Dashboard') }}</x-nav-link>
                    <x-nav-link :href="route('client.appointments.index')" :active="request()->routeIs('client.appointments.*')" class="text-white font-semibold hover:text-orange-200 transition">{{ __('My Appointments') }}</x-nav-link>
                    @elseif(auth()->user()->role === 'provider')
                    <x-nav-link :href="route('provider.dashboard')" :active="request()->routeIs('provider.dashboard')" class="text-white font-semibold hover:text-orange-200 transition">{{ __('Dashboard') }}</x-nav-link>
                    <x-nav-link :href="route('provider.appointments.index')" :active="request()->routeIs('provider.appointments.*')" class="text-white font-semibold hover:text-orange-200 transition">{{ __('Appointments') }}</x-nav-link>
                    <x-nav-link :href="route('provider.services.index')" :active="request()->routeIs('provider.services.*')" class="text-white font-semibold hover:text-orange-200 transition">{{ __('Services') }}</x-nav-link>
                    <x-nav-link :href="route('provider.business-profile.edit')" :active="request()->routeIs('provider.business-profile.*')" class="text-white font-semibold hover:text-orange-200 transition">{{ __('Business Profile') }}</x-nav-link>
                    <x-nav-link :href="route('provider.business-hours.edit')" :active="request()->routeIs('provider.business-hours.*')" class="text-white font-semibold hover:text-orange-200 transition">{{ __('Business Hours') }}</x-nav-link>
                    @endif
                    @endauth
                </div>
            </div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-2">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-5 font-semibold rounded-full text-white bg-orange-700 hover:bg-orange-800 focus:outline-none transition ease-in-out duration-150 shadow-md">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-orange-700 hover:text-orange-900 font-semibold">{{ __('Profile') }}</x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                class="text-orange-700 hover:text-orange-900 font-semibold">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-orange-200 hover:text-white hover:bg-orange-700 focus:outline-none focus:bg-orange-700 focus:text-white transition duration-150 ease-in-out">
                    <svg id="menu-icon" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path id="menu-icon-bars" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path id="menu-icon-close" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const mobileMenuButton = document.getElementById('mobile-menu-button');
                    const mobileMenu = document.getElementById('mobile-menu');
                    const menuIconBars = document.getElementById('menu-icon-bars');
                    const menuIconClose = document.getElementById('menu-icon-close');

                    mobileMenuButton.addEventListener('click', function() {
                        mobileMenu.classList.toggle('hidden');
                        menuIconBars.classList.toggle('hidden');
                        menuIconClose.classList.toggle('hidden');

                    });

                    // Close menu when clicking outside
                    document.addEventListener('click', function(event) {
                        const isClickInside = mobileMenuButton.contains(event.target) || mobileMenu.contains(event.target);
                        if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                            menuIconBars.classList.remove('hidden');
                            menuIconClose.classList.add('hidden');
                        }
                    });
                });
            </script>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div id="mobile-menu" class="hidden sm:hidden bg-orange-600">
        <div class="pt-2 pb-3 space-y-1">
            @auth
            @if(auth()->user()->role === 'client')
            <x-responsive-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')" class="text-white font-semibold hover:text-orange-200">{{ __('Dashboard') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('client.appointments.index')" :active="request()->routeIs('client.appointments.*')" class="text-white font-semibold hover:text-orange-200">{{ __('My Appointments') }}</x-responsive-nav-link>
            @elseif(auth()->user()->role === 'provider')
            <x-responsive-nav-link :href="route('provider.dashboard')" :active="request()->routeIs('provider.dashboard')" class="text-white font-semibold hover:text-orange-200">{{ __('Dashboard') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('provider.appointments.index')" :active="request()->routeIs('provider.appointments.*')" class="text-white font-semibold hover:text-orange-200">{{ __('Appointments') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('provider.services.index')" :active="request()->routeIs('provider.services.*')" class="text-white font-semibold hover:text-orange-200">{{ __('Services') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('provider.business-profile.edit')" :active="request()->routeIs('provider.business-profile.*')" class="text-white font-semibold hover:text-orange-200">{{ __('Business Profile') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('provider.business-hours.edit')" :active="request()->routeIs('provider.business-hours.*')" class="text-white font-semibold hover:text-orange-200">{{ __('Business Hours') }}</x-responsive-nav-link>
            @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-orange-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-orange-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:text-orange-200 font-semibold">{{ __('Profile') }}</x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();"
                        class="text-white hover:text-orange-200 font-semibold">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>