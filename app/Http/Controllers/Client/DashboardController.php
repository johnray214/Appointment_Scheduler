<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $totalAppointments = $user->appointments()->count();
        $upcomingAppointments = $user->appointments()
            ->where('start_time', '>', now())
            ->where('status', 'pending')
            ->count();
        $completedAppointments = $user->appointments()
            ->where('status', 'completed')
            ->count();
        
        $nextAppointments = \App\Models\Appointment::select([
                'appointments.*',
                'services.name as service_name',
                'services.price as service_price',
                'business_profiles.id as business_profile_id',
                'business_profiles.business_name',
                'business_profiles.logo_path',
                'business_profiles.address',
                'business_profiles.phone',
                'business_profiles.contact_email'
            ])
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->leftJoin('business_profiles', 'services.business_profile_id', '=', 'business_profiles.id')
            ->where('appointments.user_id', $user->id)
            ->where('appointments.start_time', '>', now())
            ->where('appointments.status', 'pending')  
            ->orderBy('appointments.start_time')
            ->take(5)
            ->get();
            
        $nextAppointments->each(function($appointment) {
            $appointment->setRelation('service', (object)[
                'id' => $appointment->service_id,
                'name' => $appointment->service_name,
                'price' => $appointment->service_price,
                'business_profile_id' => $appointment->business_profile_id,
                'businessProfile' => (object)[
                    'id' => $appointment->business_profile_id,
                    'business_name' => $appointment->business_name,
                    'logo_path' => $appointment->logo_path,
                    'address' => $appointment->address,
                    'phone' => $appointment->phone,
                    'contact_email' => $appointment->contact_email
                ]
            ]);
        });

        return view('client.dashboard', compact(
            'totalAppointments',
            'upcomingAppointments',
            'completedAppointments',
            'nextAppointments'
        ));
    }
}
