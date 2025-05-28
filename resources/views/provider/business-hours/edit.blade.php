<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Business Hours</h2>

                    @if (session('success'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative transition duration-500 ease-in-out transform" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('provider.business-hours.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                <div class="flex items-center space-x-4">
                                    <div class="w-32">
                                        <span class="text-gray-700 font-medium">{{ ucfirst($day) }}</span>
                                    </div>

                                    <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" 
                                                id="{{ $day }}_closed" 
                                                name="hours[{{ $day }}][closed]" 
                                                value="1"
                                                class="rounded border-gray-300 text-orange-600 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                                                {{ $businessHours[$day]['closed'] ? 'checked' : '' }}
                                                onchange="toggleHours('{{ $day }}')"
                                            >
                                            <label for="{{ $day }}_closed" class="text-sm text-gray-600">Closed</label>
                                        </div>

                                        <div class="flex items-center space-x-2" id="{{ $day }}_hours" {{ $businessHours[$day]['closed'] ? 'style=display:none' : '' }}>
                                            <div>
                                                <x-input-label for="{{ $day }}_open" :value="__('Open')" />
                                                <input type="time" 
                                                    id="{{ $day }}_open" 
                                                    name="hours[{{ $day }}][open]" 
                                                    value="{{ $businessHours[$day]['open'] }}"
                                                    class="mt-1 block w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm"
                                                    {{ $businessHours[$day]['closed'] ? 'disabled' : '' }}
                                                >
                                            </div>
                                            <div>
                                                <x-input-label for="{{ $day }}_close" :value="__('Close')" />
                                                <input type="time" 
                                                    id="{{ $day }}_close" 
                                                    name="hours[{{ $day }}][close]" 
                                                    value="{{ $businessHours[$day]['close'] }}"
                                                    class="mt-1 block w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm"
                                                    {{ $businessHours[$day]['closed'] ? 'disabled' : '' }}
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="flex items-center justify-end mt-6">
                                <x-primary-button>
                                    {{ __('Update Business Hours') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleHours(day) {
            const hoursDiv = document.getElementById(`${day}_hours`);
            const openInput = document.getElementById(`${day}_open`);
            const closeInput = document.getElementById(`${day}_close`);
            const isClosed = document.getElementById(`${day}_closed`).checked;

            if (isClosed) {
                hoursDiv.style.display = 'none';
                openInput.disabled = true;
                closeInput.disabled = true;
            } else {
                hoursDiv.style.display = 'flex';
                openInput.disabled = false;
                closeInput.disabled = false;
            }
        }
    </script>
    @endpush
</x-app-layout>
