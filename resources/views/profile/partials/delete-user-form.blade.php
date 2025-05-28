<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        id="delete-account-button"
        onclick="document.getElementById('confirm-user-deletion').style.display = 'block'; document.body.classList.add('overflow-y-hidden');"
    >{{ __('Delete Account') }}</x-danger-button>

    <div id="confirm-user-deletion" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: none;">
        <div class="fixed inset-0 transform transition-all">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="mb-6 transform transition-all sm:max-w-lg sm:w-full sm:mx-auto">
            <form method="post" action="{{ route('profile.destroy') }}" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                @csrf
                @method('delete')
                
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Are you sure you want to delete your account?') }}
                    </h2>


                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>


                    <div class="mt-6">
                        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                        <x-text-input
                            id="password"
                            name="password"
                            type="password"
                            class="mt-1 block w-3/4"
                            placeholder="{{ __('Password') }}"
                        />

                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>


                    <div class="mt-6 flex justify-end">
                        <x-secondary-button type="button" onclick="document.getElementById('confirm-user-deletion').style.display = 'none'; document.body.classList.remove('overflow-y-hidden');">
                            {{ __('Cancel') }}
                        </x-secondary-button>


                        <x-danger-button type="submit" class="ms-3">
                            {{ __('Delete Account') }}
                        </x-danger-button>
                    </div>
                </div>
            </form>
        </div>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('confirm-user-deletion');
            const closeButton = modal.querySelector('button[type="button"]');
            const deleteButton = document.getElementById('delete-account-button');
            
            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                    document.body.classList.remove('overflow-y-hidden');
                }
            });
            
            // Close modal with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && modal.style.display === 'block') {
                    modal.style.display = 'none';
                    document.body.classList.remove('overflow-y-hidden');
                }
            });
        });
        </script>
    </div>
</section>
