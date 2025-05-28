<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProviderDashboardController extends Controller
{
    public function index()
    {
        $businessId = auth()->user()->businessProfile->id;

        $appointments = Appointment::where('business_profile_id', $businessId)
            ->whereDate('start_time', Carbon::today())
            ->with(['user', 'service'])
            ->orderBy('start_time')
            ->get();

        $stats = [
            'total_appointments' => Appointment::where('business_profile_id', $businessId)->count(),
            'today' => $appointments->count(),
            'revenue' => Appointment::where('appointments.business_profile_id', $businessId)
                ->where('appointments.status', 'completed')
                ->join('services', 'appointments.service_id', '=', 'services.id')
                ->sum('services.price') ?? 0,
            'completed' => Appointment::where('business_profile_id', $businessId)
                ->where('status', 'completed')
                ->count(),
        ];

        \Log::info('Business ID: ' . $businessId);
        
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays(6);
        
        \Log::info('Appointments date range: ' . $startDate->format('Y-m-d') . ' to ' . $endDate->format('Y-m-d'));
        
        $appointmentsData = Appointment::where('business_profile_id', $businessId)
            ->whereDate('start_time', '>=', $startDate)
            ->whereDate('start_time', '<=', $endDate)
            ->select(DB::raw('DATE(start_time) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        \Log::info('Raw appointments data:', $appointmentsData->toArray());
        
        $appointmentsData = $appointmentsData->pluck('count', 'date')->toArray();
        
        \Log::info('Processed appointments data:', $appointmentsData);

        $chartDates = [];
        $chartCounts = [];
        
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dateString = $date->format('Y-m-d');
            $chartDates[] = $date->format('M d (D)');
            $chartCounts[] = $appointmentsData[$dateString] ?? 0;
        }
        
        \Log::info('Chart dates:', $chartDates);
        \Log::info('Chart counts:', $chartCounts);

        $servicesStartDate = Carbon::now();
        $servicesEndDate = Carbon::now()->addDays(30);
        
        \Log::info('Services date range: from ' . $servicesStartDate->format('Y-m-d') . ' to ' . $servicesEndDate->format('Y-m-d'));
        
        $servicesData = Service::where('business_profile_id', $businessId)
            ->where('is_visible', true)
            ->withCount(['appointments' => function($query) use ($servicesStartDate, $servicesEndDate) {
                $query->whereIn('status', ['confirmed', 'completed'])
                      ->where('start_time', '>=', $servicesStartDate)
                      ->where('start_time', '<=', $servicesEndDate);
            }])
            ->orderByDesc('appointments_count')
            ->limit(5)
            ->get();
            
        \Log::info('Services with appointments count:', $servicesData->toArray());
            
        if ($servicesData->sum('appointments_count') === 0) {
            $servicesData = Service::where('business_profile_id', $businessId)
                ->where('is_visible', true)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function($service) {
                    $service->appointments_count = 0;
                    return $service;
                });
                
            \Log::info('Showing recently added services (no upcoming appointments):', $servicesData->toArray());
        }

        $chartData = [
            'appointments' => [
                'labels' => $chartDates,
                'data' => $chartCounts
            ],
            'services' => [
                'labels' => $servicesData->pluck('name')->toArray() ?: ['No data'],
                'data' => $servicesData->pluck('appointments_count')->toArray() ?: [0]
            ]
        ];

        \Log::info('Dashboard Data:', [
            'appointments_count' => $appointments->count(),
            'stats' => $stats,
            'chart_data' => $chartData
        ]);

        $serviceUsageData = $this->getServiceUsageData($businessId);

        return view('provider.dashboard', [
            'appointments' => $appointments,
            'stats' => $stats,
            'charts' => $chartData,
            'services' => $servicesData,
            'serviceUsageData' => $serviceUsageData,
        ]);
    }

    private function getServiceUsageData($businessId)
    {
        \Log::info('Getting service usage data for business: ' . $businessId);
        
        $services = Service::where('business_profile_id', $businessId)
            ->where('is_visible', true)
            ->withCount([
                'appointments as total_appointments',
                'appointments as completed_appointments' => function($query) {
                    $query->where('status', 'completed');
                },
                'appointments as cancelled_appointments' => function($query) {
                    $query->where('status', 'cancelled');
                },
                'appointments as pending_appointments' => function($query) {
                    $query->whereIn('status', ['pending', 'confirmed']);
                }
            ])
            ->orderBy('name')
            ->get();
            
        \Log::info('Services found: ' . $services->count());
        \Log::info('Services data: ' . json_encode($services->toArray()));

        if ($services->isEmpty()) {
            return [
                'labels' => [],
                'datasets' => [],
                'services' => []
            ];
        }

        $labels = [];
        $completedData = [];
        $pendingData = [];
        $cancelledData = [];
        
        foreach ($services as $service) {
            $labels[] = strlen($service->name) > 20 ? substr($service->name, 0, 20).'...' : $service->name;
            $completedData[] = $service->completed_appointments;
            $pendingData[] = $service->pending_appointments;
            $cancelledData[] = $service->cancelled_appointments;
        }

        $datasets = [
            [
                'label' => 'Completed',
                'data' => $completedData,
                'backgroundColor' => 'rgba(16, 185, 129, 0.8)',
                'borderColor' => 'rgba(16, 185, 129, 1)',
                'borderWidth' => 1
            ],
            [
                'label' => 'Pending/Confirmed',
                'data' => $pendingData,
                'backgroundColor' => 'rgba(245, 158, 11, 0.8)',
                'borderColor' => 'rgba(245, 158, 11, 1)',
                'borderWidth' => 1
            ],
            [
                'label' => 'Cancelled',
                'data' => $cancelledData,
                'backgroundColor' => 'rgba(239, 68, 68, 0.8)',
                'borderColor' => 'rgba(239, 68, 68, 1)',
                'borderWidth' => 1
            ]
        ];

        $result = [
            'labels' => $labels,
            'datasets' => $datasets,
            'services' => $services->toArray()
        ];
        
        \Log::info('Chart data prepared: ' . json_encode($result));
        
        return $result;
    }

    private function getAppointmentsChartData($businessId)
    {
        $days = collect();
        $data = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $days->push($date->format('D'));

            $count = Appointment::where('business_profile_id', $businessId)
                ->whereDate('start_time', $date)
                ->count();

            $data->push($count);
        }

        return [
            'labels' => $days,
            'data' => $data,
        ];
    }

    private function getServicesChartData($businessId)
    {
        $services = Service::where('business_profile_id', $businessId)
            ->where('is_visible', true)
            ->withCount(['appointments' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->orderByDesc('appointments_count')
            ->take(5)
            ->get();

        return [
            'labels' => $services->pluck('name'),
            'data' => $services->pluck('appointments_count'),
        ];
    }
}
