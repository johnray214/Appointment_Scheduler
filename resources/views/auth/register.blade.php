<x-guest-layout>
    <div class="max-h-[80vh] overflow-y-auto px-1 -mx-1" style="-webkit-overflow-scrolling: touch;">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-extrabold text-orange-600">
                @if(request('role') === 'provider')
                    Register as Salon/Barber
                @else
                    Register as Client
                @endif
            </h2>
            <p class="mt-1 text-base text-gray-500">Create your account to get started</p>
        </div>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <!-- Role -->
            <input type="hidden" name="role" value="{{ request('role', 'client') }}">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="text-sm text-gray-500">
                <p>Note: This is for provider account only if your a client register as a client.</p>
            </div>
            <div class="flex items-center justify-between mt-4">
                <a class="underline text-base text-orange-600 hover:text-orange-800 transition rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <x-primary-button class="w-1/2 bg-orange-600 hover:bg-orange-700 text-lg font-bold py-2 transition">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
