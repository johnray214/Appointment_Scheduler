<x-provider-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($appointments->count() > 0)
                    <div class="p-6">
                    <div class="overflow-x-auto">
    <div class="min-w-full inline-block align-middle overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-300">

                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Date & Time</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Client</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Service</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-900 sm:pl-6">
                                                <div class="font-medium">{{ $appointment->start_time->format('M j, Y') }}</div>
                                                <div class="text-gray-500">{{ $appointment->start_time->format('g:i A') }}</div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <div class="font-medium text-gray-900">{{ $appointment->user_name }}</div>
                                                <div class="text-gray-500">{{ $appointment->user_email }}</div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <div class="font-medium text-gray-900">{{ $appointment->service_name }}</div>
                                                <div class="text-gray-500">₱{{ number_format($appointment->service_price, 2) }}</div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                                    @if($appointment->status === 'completed') bg-green-100 text-green-800
                                                    @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                                                    @elseif($appointment->status === 'confirmed') bg-blue-100 text-blue-800
                                                    @else bg-yellow-100 text-yellow-800
                                                    @endif">
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                <a href="{{ route('provider.appointments.show', $appointment->id) }}" class="text-orange-600 hover:text-orange-900">View<span class="sr-only">, {{ $appointment->user_name }}</span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($appointments->hasPages())
                            <div class="px-6 py-4 border-t">
                                {{ $appointments->links() }}
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No appointments today</h3>
                        <p class="mt-1 text-sm text-gray-500">Your schedule is clear for now.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-provider-layout>
