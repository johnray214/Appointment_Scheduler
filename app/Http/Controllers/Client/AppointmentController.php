<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\BusinessProfile;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AppointmentController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $appointments = Appointment::select('appointments.*')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->leftJoin('business_profiles', 'services.business_profile_id', '=', 'business_profiles.id')
            ->where('appointments.user_id', auth()->id())
            ->orderBy('appointments.start_time', 'desc')
            ->with(['service', 'businessProfile'])
            ->paginate(10);

        return view('client.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $businesses = BusinessProfile::where('is_active', true)
            ->with(['businessHours', 'services' => function($query) {
                $query->where('is_visible', true);
            }])
            ->get();

        return view('client.appointments.create', compact('businesses'));
    }

    
    public function store(Request $request)
{
    $validated = $request->validate([
        'service_id' => 'required|exists:services,id',
        'date' => 'required|date|after_or_equal:today',
        'time' => 'required',
    ]);

    $service = Service::with('business')->findOrFail($validated['service_id']);
    $business = $service->business;
    
    $appointmentDateTime = Carbon::parse($validated['date'] . ' ' . $validated['time']);
    $dayOfWeek = strtolower($appointmentDateTime->format('l'));
    $selectedTime = $appointmentDateTime->format('H:i');
    
    $businessHours = $business->business_hours[$dayOfWeek] ?? null;
    
    if (!$businessHours || !$businessHours['enabled']) {
        return back()->withErrors(['time' => 'The business is closed on ' . ucfirst($dayOfWeek)])->withInput();
    }
    
    $openTime = Carbon::createFromFormat('H:i', $businessHours['open']);
    $closeTime = Carbon::createFromFormat('H:i', $businessHours['close']);
    $selectedTimeObj = Carbon::createFromFormat('H:i', $selectedTime);
    
    if ($selectedTimeObj->lt($openTime) || $selectedTimeObj->gt($closeTime)) {
        return back()->withErrors(['time' => 'The selected time is outside of business hours.'])->withInput();
    }

    $endTime = (clone $appointmentDateTime)->addMinutes($service->duration);
    
    $hasOverlap = Appointment::where('business_profile_id', $business->id)
        ->where('status', '!=', 'cancelled')
        ->where(function ($query) use ($appointmentDateTime, $endTime) {
            $query->whereBetween('start_time', [$appointmentDateTime, $endTime])
                ->orWhereBetween('end_time', [$appointmentDateTime, $endTime])
                ->orWhere(function ($q) use ($appointmentDateTime, $endTime) {
                    $q->where('start_time', '<=', $appointmentDateTime)
                      ->where('end_time', '>=', $endTime);
                });
        })
        ->exists();

    if ($hasOverlap) {
        return back()
            ->withErrors(['time' => 'This time slot is already booked.'])
            ->withInput();
    }

    $appointment = Appointment::create([
        'user_id' => auth()->id(),
        'service_id' => $service->id,
        'business_profile_id' => $business->id,
        'start_time' => $appointmentDateTime,
        'end_time' => $endTime,
        'status' => 'pending',
        'price' => $service->price,
        'notes' => $request->input('notes')
    ]);

    return redirect()->route('client.appointments.index')
        ->with('success', 'Appointment booked successfully!');
}

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        
        $appointment->load('service.business');
        
        return view('client.appointments.show', compact('appointment'));
    }

    public function cancel(Appointment $appointment)
    {
        $this->authorize('cancel', $appointment);

        if ($appointment->status === 'cancelled') {
            return back()->withErrors(['status' => 'This appointment is already cancelled.']);
        }

        if ($appointment->start_time->isPast()) {
            return back()->withErrors(['status' => 'Cannot cancel past appointments.']);
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment cancelled successfully.');
    }
    
    public function confirm(Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        if ($appointment->status === 'confirmed') {
            return back()->with('info', 'Appointment is already confirmed.');
        }

        $appointment->update(['status' => 'confirmed']);

        return back()->with('success', 'Appointment confirmed successfully!');
    }
}
