<x-provider-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business Profile Setup') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative transition duration-500 ease-in-out transform" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('provider.business-profile.store') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <!-- Business Name -->
                        <div>
                            <x-input-label for="business_name" :value="__('Business Name')" />
                            <x-text-input id="business_name" name="business_name" type="text" class="mt-1 block w-full" :value="old('business_name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('business_name')" />
                        </div>

                        <!-- Business Type -->
                        <div>
                            <x-input-label for="business_type" :value="__('Business Type')" />
                            <select id="business_type" name="business_type" class="mt-1 block w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm" required>
                                <option value="">Select business type...</option>
                                <option value="Salon" {{ old('business_type') === 'Salon' ? 'selected' : '' }}>Salon</option>
                                <option value="Barber Shop" {{ old('business_type') === 'Barber Shop' ? 'selected' : '' }}>Barber Shop</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('business_type')" />
                        </div>

                        <!-- Business Description -->
                        <div>
                            <x-input-label for="description" :value="__('Business Description')" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- Contact Email -->
                        <div>
                            <x-input-label for="contact_email" :value="__('Contact Email')" />
                            <x-text-input id="contact_email" name="contact_email" type="email" class="mt-1 block w-full" :value="old('contact_email')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('contact_email')" />
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <x-input-label for="phone" :value="__('Phone Number')" />
                            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <!-- Address -->
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <!-- Business Logo -->
                        <div>
                            <x-input-label for="logo" :value="__('Business Logo')" />
                            <input id="logo" name="logo" type="file" accept="image/*" class="mt-1 block w-full" />
                            <p class="mt-1 text-sm text-gray-500">Recommended size: 200x200 pixels</p>
                            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Profile') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-provider-layout>
