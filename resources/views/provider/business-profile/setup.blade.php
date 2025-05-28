<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Set Up Your Business Profile</h2>

                    <form action="{{ route('provider.business-profile.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-6">
                            <!-- Business Name -->
                            <div>
                                <x-input-label for="business_name" :value="__('Business Name')" />
                                <x-text-input id="business_name" name="business_name" type="text" class="mt-1 block w-full" :value="old('business_name')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('business_name')" />
                            </div>

                            <!-- Business Type -->
                            <div>
                                <x-input-label for="business_type" :value="__('Business Type')" />
                                <select id="business_type" name="business_type" class="mt-1 block w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm">
                                    <option value="Salon" {{ old('business_type') === 'Salon' ? 'selected' : '' }}>Salon</option>
                                    <option value="Barber Shop" {{ old('business_type') === 'Barber Shop' ? 'selected' : '' }}>Barber Shop</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('business_type')" />
                            </div>

                            <!-- Description -->
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <!-- Contact Email -->
                            <div>
                                <x-input-label for="contact_email" :value="__('Business Email')" />
                                <x-text-input id="contact_email" name="contact_email" type="email" class="mt-1 block w-full" :value="old('contact_email')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('contact_email')" />
                            </div>

                            <!-- Phone -->
                            <div>
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <!-- Address -->
                            <div>
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                            <!-- Logo -->
                            <div>
                                <x-input-label for="logo" :value="__('Logo')" />
                                <input id="logo" name="logo" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-orange-50 file:text-orange-700
                                    hover:file:bg-orange-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('logo')" />
                            </div>

                            <div class="flex items-center justify-end mt-6">
                                <x-primary-button>
                                    {{ __('Create Business Profile') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
