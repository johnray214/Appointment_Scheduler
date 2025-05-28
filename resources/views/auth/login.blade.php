<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 flex items-center justify-center">
            <div class="flex items-center bg-green-100 border border-green-300 text-green-800 text-sm rounded-lg px-4 py-3 w-full max-w-xs shadow transition">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                <span>{{ session('status') }}</span>
            </div>
        </div>
    @endif
    <div class="max-h-[80vh] overflow-y-auto px-1 -mx-1" style="-webkit-overflow-scrolling: touch;">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-extrabold text-orange-600">Welcome Back</h2>
            <p class="mt-1 text-base text-gray-500">Please sign in to your account</p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-orange-600 hover:text-orange-800 transition rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div>
                <x-primary-button class="w-full bg-orange-600 hover:bg-orange-700 text-lg font-bold py-2 transition">{{ __('Log in') }}</x-primary-button>
            </div>
        </form>
        <div class="mt-6">
            <div class="relative flex items-center justify-center">
                <div class="absolute w-full border-t border-gray-300"></div>
                <div class="relative px-4 bg-white text-gray-400 text-sm">Or continue with</div>
            </div>
            <div class="mt-4 grid grid-cols-1 gap-3">
                <a href="{{ route('register', ['role' => 'client']) }}" class="w-full inline-flex justify-center py-2 px-4 border-2 border-orange-500 rounded-lg shadow-sm bg-white text-base font-semibold text-orange-600 hover:bg-orange-50 hover:text-orange-700 transition">Register as Client</a>
                <a href="{{ route('register', ['role' => 'provider']) }}" class="w-full inline-flex justify-center py-2 px-4 border-2 border-orange-500 rounded-lg shadow-sm bg-white text-base font-semibold text-orange-600 hover:bg-orange-50 hover:text-orange-700 transition">Register as Salon/Barber</a>
            </div>
        </div>
    </div>
</x-guest-layout>
