<x-provider-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Total Appointments -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-orange-100 rounded-lg p-3">
                            <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <div class="text-sm font-medium text-gray-500">Total Appointments</div>
                            <div class="text-3xl font-bold text-orange-600">{{ $stats['total_appointments'] }}</div>
                        </div>
                    </div>
                </div>

                <!-- Today's Appointments -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-orange-100 rounded-lg p-3">
                            <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <div class="text-sm font-medium text-gray-500">Today's Appointments</div>
                            <div class="text-3xl font-bold text-orange-600">{{ $stats['today'] }}</div>
                        </div>
                    </div>
                </div>

                <!-- Revenue -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-orange-100 rounded-lg p-3">
                            <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <div class="text-sm font-medium text-gray-500">Total Revenue</div>
                            <div class="text-3xl font-bold text-orange-600">₱{{ number_format($stats['revenue'], 2) }}</div>
                        </div>
                    </div>
                </div>

                <!-- Completed Appointments -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-orange-100 rounded-lg p-3">
                            <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <div class="text-sm font-medium text-gray-500">Completed Appointments</div>
                            <div class="text-3xl font-bold text-orange-600">{{ $stats['completed'] }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Hours Overview -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Business Hours</h3>
                        <a href="{{ route('provider.business-hours.edit') }}" class="text-sm text-orange-600 hover:text-orange-700">Edit Hours</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            @php
                                $dayLower = strtolower($day);
                                $hours = auth()->user()->businessProfile->business_hours[$dayLower] ?? null;
                            @endphp
                            <div class="border rounded-lg p-4">
                                <div class="font-medium text-gray-700 mb-2">{{ $day }}</div>
                                @if($hours && $hours['enabled'])
                                    <div class="text-sm text-gray-600">
                                        {{ date('g:i A', strtotime($hours['open'])) }} - {{ date('g:i A', strtotime($hours['close'])) }}
                                    </div>
                                @else
                                    <div class="text-sm text-gray-500">Closed</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            
            <!-- Service Usage Chart -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl p-8 mb-8 border border-gray-100">
                <div class="flex flex-col items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight uppercase">Service Usage Infographic</h3>
                    <p class="text-base text-gray-500 mt-2 text-center max-w-2xl">See how each service performed recently. Completed, pending, and cancelled appointments are shown side by side for easy comparison.</p>
                </div>
                @if(!empty($serviceUsageData['datasets']))
                    <div class="relative" style="height: 340px;">
                        <div class="absolute inset-0">
                            <canvas id="serviceUsageChart" class="rounded-xl shadow"></canvas>
                        </div>
                    </div>
                    <script>
                        if (window.serviceUsageChartInstance) {
                            window.serviceUsageChartInstance.destroy();
                            window.serviceUsageChartInstance = null;
                        }
                        document.addEventListener('DOMContentLoaded', function() {
                            const ctx = document.getElementById('serviceUsageChart');
                            if (ctx && typeof Chart !== 'undefined') {
                                if (window.serviceUsageChartInstance) {
                                    window.serviceUsageChartInstance.destroy();
                                }
                                const palette = [
                                    'rgba(59, 130, 246, 0.8)',   // blue
                                    'rgba(16, 185, 129, 0.8)',   // green
                                    'rgba(132, 204, 22, 0.8)'    // light green
                                ];
                                const borderPalette = [
                                    'rgba(59, 130, 246, 1)',
                                    'rgba(16, 185, 129, 1)',
                                    'rgba(132, 204, 22, 1)'
                                ];
                                const datasets = @json($serviceUsageData['datasets'] ?? []).map((ds, i) => ({
                                    ...ds,
                                    backgroundColor: palette[i % palette.length],
                                    borderColor: borderPalette[i % borderPalette.length],
                                    borderWidth: 1.5,
                                    borderRadius: 4,
                                    barPercentage: 0.7,
                                    categoryPercentage: 0.7,
                                    stack: undefined // disables stacking
                                }));
                                window.serviceUsageChartInstance = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: @json($serviceUsageData['labels'] ?? []),
                                        datasets: datasets
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                grid: { color: '#f3f4f6' },
                                                ticks: { color: '#374151', font: { weight: 'bold' } }
                                            },
                                            y: {
                                                beginAtZero: true,
                                                grid: { color: '#f3f4f6' },
                                                ticks: { color: '#374151', font: { weight: 'bold' }, precision: 0, stepSize: 1 }
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: true,
                                                position: 'top',
                                                labels: {
                                                    color: '#111827',
                                                    font: { size: 14, weight: 'bold' },
                                                    usePointStyle: true
                                                }
                                            },
                                            tooltip: {
                                                backgroundColor: '#111827',
                                                titleColor: '#fbbf24',
                                                bodyColor: '#f3f4f6',
                                                borderColor: '#fbbf24',
                                                borderWidth: 1,
                                                callbacks: {
                                                    label: function(context) {
                                                        return context.dataset.label + ': ' + context.raw;
                                                    }
                                                }
                                            },
                                            datalabels: {
                                                anchor: 'end',
                                                align: 'end',
                                                color: '#374151',
                                                font: { weight: 'bold' },
                                                formatter: Math.round
                                            }
                                        }
                                    },
                                    plugins: [window.ChartDataLabels || {}]
                                });
                            }
                        });
                    </script>
                @else
                    <div class="text-center py-12 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="mt-2">No service usage data available</p>
                        @if(!empty($serviceUsageData['services']) && count($serviceUsageData['services']) > 0)
                            <p class="mt-1 text-sm">You have services but no appointments yet.</p>
                        @else
                            <p class="mt-1 text-sm">Add some services and appointments to see data here.</p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Appointments Chart -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl p-8 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Appointments (Last 7 Days)</h3>
                    <p class="text-sm text-gray-500 mb-4">This chart shows the number of appointments scheduled for each of the last 7 days, including today. Use it to spot trends and busy days at a glance.</p>
                    @if(array_sum($charts['appointments']['data']) > 0)
                        <div style="height: 350px;">
                            <canvas id="appointmentsChart" class="rounded-xl shadow"></canvas>
                        </div>
                    @else
                        <div class="text-center py-12 text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="mt-2">No appointments in the last 7 days</p>
                        </div>
                    @endif
                </div>

                <!-- Services Chart -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl p-8 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Popular Services (Last 30 Days)</h3>
                    <p class="text-sm text-gray-500 mb-4">See which services have been completed most often in the last 30 days. This helps you understand what your clients love most.</p>
                    @php
                        $popularLabels = $serviceUsageData['labels'] ?? [];
                        $popularData = $serviceUsageData['datasets'][0]['data'] ?? [];
                    @endphp
                    @if(array_sum($popularData) > 0)
                        <div style="height: 400px;">
                            <canvas id="servicesChart" class="w-full h-full rounded-xl shadow"></canvas>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const ctx = document.getElementById('servicesChart');
                                if (ctx && typeof Chart !== 'undefined') {
                                    const colors = [
                                        'rgba(59, 130, 246, 0.8)',   // blue
                                        'rgba(251, 191, 36, 0.8)',   // yellow
                                        'rgba(16, 185, 129, 0.8)',   // green
                                        'rgba(168, 85, 247, 0.8)',   // purple
                                        'rgba(239, 68, 68, 0.8)',    // red
                                        'rgba(236, 72, 153, 0.8)',   // pink
                                        'rgba(34, 197, 94, 0.8)',    // emerald
                                        'rgba(14, 165, 233, 0.8)',   // sky
                                        'rgba(245, 158, 11, 0.8)',   // orange
                                        'rgba(52, 211, 153, 0.8)',   // teal
                                    ];
                                    const borderColors = [
                                        'rgba(59, 130, 246, 1)',
                                        'rgba(251, 191, 36, 1)',
                                        'rgba(16, 185, 129, 1)',
                                        'rgba(168, 85, 247, 1)',
                                        'rgba(239, 68, 68, 1)',
                                        'rgba(236, 72, 153, 1)',
                                        'rgba(34, 197, 94, 1)',
                                        'rgba(14, 165, 233, 1)',
                                        'rgba(245, 158, 11, 1)',
                                        'rgba(52, 211, 153, 1)',
                                    ];
                                    new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: @json($popularLabels),
                                            datasets: [{
                                                label: 'Completed Appointments',
                                                data: @json($popularData),
                                                backgroundColor: colors.slice(0, @json(count($popularLabels))),
                                                borderColor: borderColors.slice(0, @json(count($popularLabels))),
                                                borderWidth: 2,
                                                borderRadius: 8,
                                            }]
                                        },
                                        options: {
                                            indexAxis: 'y',
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            scales: {
                                                x: {
                                                    beginAtZero: true,
                                                    ticks: { precision: 0, stepSize: 1 },
                                                    grid: { color: '#f3f4f6' }
                                                },
                                                y: { grid: { display: false } }
                                            },
                                            plugins: {
                                                legend: { display: false },
                                                tooltip: {
                                                    backgroundColor: '#111827',
                                                    titleColor: '#fbbf24',
                                                    bodyColor: '#f3f4f6',
                                                    borderColor: '#fbbf24',
                                                    borderWidth: 1,
                                                    callbacks: {
                                                        label: function(context) {
                                                            return context.raw + ' completed';
                                                        }
                                                    }
                                                },
                                                datalabels: {
                                                    anchor: 'end',
                                                    align: 'right',
                                                    color: '#374151',
                                                    font: { weight: 'bold' },
                                                    formatter: Math.round
                                                }
                                            }
                                        },
                                        plugins: [window.ChartDataLabels || {}]
                                    });
                                }
                            });
                        </script>
                    @else
                        <div class="text-center py-12 text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <p class="mt-2">No service data available</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Today's Appointments -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Today's Appointments</h3>
                        <a href="{{ route('provider.appointments.index') }}" class="text-sm text-orange-600 hover:text-orange-700">View All</a>
                    </div>

                    @if($appointments->count() > 0)
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8" style="-webkit-overflow-scrolling: touch;">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg" style="min-width: 800px;">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Time</th>
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
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                        {{ $appointment->start_time->format('h:i A') }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        <div class="font-medium text-gray-900">{{ $appointment->user->name }}</div>
                                                        <div class="text-gray-500">{{ $appointment->user->email }}</div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        <div class="font-medium text-gray-900">{{ $appointment->service->name }}</div>
                                                        <div class="text-gray-500">₱{{ number_format($appointment->service->price, 2) }}</div>
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
                                                        <a href="{{ route('provider.appointments.show', $appointment) }}" class="text-orange-600 hover:text-orange-900">View<span class="sr-only">, {{ $appointment->user->name }}</span></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4 text-gray-500">No appointments scheduled for today</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-provider-layout>

<script>
if (window.appointmentsChartInstance) {
    window.appointmentsChartInstance.destroy();
    window.appointmentsChartInstance = null;
}
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('appointmentsChart');
    if (ctx && typeof Chart !== 'undefined') {
        if (window.appointmentsChartInstance) {
            window.appointmentsChartInstance.destroy();
        }
        window.appointmentsChartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($charts['appointments']['labels']),
                datasets: [{
                    label: 'Appointments',
                    data: @json($charts['appointments']['data']),
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    barPercentage: 0.7,
                    categoryPercentage: 0.7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, stepSize: 1 },
                        grid: { color: '#f3f4f6' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#374151', font: { weight: 'bold' } }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#fbbf24',
                        bodyColor: '#f3f4f6',
                        borderColor: '#fbbf24',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return context.raw + ' appointment' + (context.raw === 1 ? '' : 's');
                            }
                        }
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#374151',
                        font: { weight: 'bold' },
                        formatter: Math.round
                    }
                }
            },
            plugins: [window.ChartDataLabels || {}]
        });
    }
});
</script>
