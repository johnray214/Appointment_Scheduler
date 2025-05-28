<x-provider-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Set Business Hours') }}
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
                    <form method="POST" action="{{ route('provider.business-hours.store') }}" class="space-y-6">
                        @csrf

                        @php
                            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        @endphp

                        @foreach($days as $day)
                            <div class="border-b pb-4 mb-4 last:border-b-0">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-medium">{{ $day }}</h3>
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               id="{{ strtolower($day) }}_enabled"
                                               name="days[{{ strtolower($day) }}][enabled]"
                                               value="1"
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                               @checked(old("days.".strtolower($day).".enabled", $businessHours[strtolower($day)]['enabled'] ?? false))
                                               >
                                        <label for="{{ strtolower($day) }}_enabled" class="ml-2">Open</label>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label :value="__('Opening Time')" />
                                        <select name="days[{{ strtolower($day) }}][open]"
                                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            @for($hour = 0; $hour < 24; $hour++)
                                                @foreach(['00', '30'] as $minute)
                                                    @php
                                                        $time = sprintf('%02d:%s', $hour, $minute);
                                                        $displayTime = date('g:i A', strtotime($time));
                                                    @endphp
                                                    <option value="{{ $time }}" @selected(old("days.".strtolower($day).".open", $businessHours[strtolower($day)]['open'] ?? '09:00') === $time)>
                                                        {{ $displayTime }}
                                                    </option>
                                                @endforeach
                                            @endfor
                                        </select>
                                    </div>

                                    <div>
                                        <x-input-label :value="__('Closing Time')" />
                                        <select name="days[{{ strtolower($day) }}][close]"
                                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            @for($hour = 0; $hour < 24; $hour++)
                                                @foreach(['00', '30'] as $minute)
                                                    @php
                                                        $time = sprintf('%02d:%s', $hour, $minute);
                                                        $displayTime = date('g:i A', strtotime($time));
                                                    @endphp
                                                    <option value="{{ $time }}" @selected(old("days.".strtolower($day).".close", $businessHours[strtolower($day)]['close'] ?? '17:00') === $time)>
                                                        {{ $displayTime }}
                                                    </option>
                                                @endforeach
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Business Hours') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-provider-layout>
