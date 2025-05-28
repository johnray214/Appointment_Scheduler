<x-provider-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('provider.services.store') }}" class="p-6">
                    @csrf

                    <div class="space-y-6">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Service Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- Price -->
                        <div>
                            <x-input-label for="price" :value="__('Price')" />
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">₱</span>
                                </div>
                                <x-text-input type="number" name="price" id="price" step="0.01" min="0" class="block w-full pl-7" :value="old('price')" required />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <!-- Duration -->
                        <div>
                            <x-input-label for="duration" :value="__('Duration (minutes)')" />
                            <x-text-input type="number" name="duration" id="duration" min="15" step="15" class="mt-1 block w-full" :value="old('duration', 60)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                        </div>

                        <!-- Visibility -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="is_visible" name="is_visible" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-orange-600 focus:ring-orange-500" value="1" {{ old('is_visible') ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_visible" class="font-medium text-gray-700">Visible to Clients</label>
                                <p class="text-gray-500">Make this service available for booking</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <a href="{{ route('provider.services.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Create Service
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-provider-layout>
