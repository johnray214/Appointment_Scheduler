<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderAppointmentController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role !== 'provider') {
            abort(403);
        }

        $businessId = Auth::user()->businessProfile->id;
        $query = Appointment::where('business_id', $businessId)
            ->with(['user', 'service'])
            ->orderBy('start_time');

        $tab = $request->get('tab', 'today');
        
        switch ($tab) {
            case 'today':
                $query->whereDate('start_time', now()->toDateString());
                break;
            case 'upcoming':
                $query->whereDate('start_time', '>', now()->toDateString());
                break;
            case 'past':
                $query->whereDate('start_time', '<', now()->toDateString());
                break;
        }

        $appointments = $query->get();

        return view('provider.appointments.index', compact('appointments'));
    }

    public function calendar()
    {
        if (Auth::user()->role !== 'provider') {
            abort(403);
        }

        $businessId = Auth::user()->businessProfile->id;
        $appointments = Appointment::where('business_id', $businessId)
            ->with(['user', 'service'])
            ->orderBy('start_time')
            ->get();

        $hours = Auth::user()->businessProfile->businessHours()->where('closed', false)->get();
        $businessHours = $hours->map(function($h) {
            return [
                'daysOfWeek' => [(int)$h->day_of_week],
                'startTime' => $h->open_time,
                'endTime' => $h->close_time,
            ];
        });

        return view('provider.appointments.calendar', compact('appointments', 'businessHours'));
    }

    public function show(Appointment $appointment)
    {
        if (Auth::user()->role !== 'provider') {
            abort(403);
        }

        if ($appointment->business_id !== Auth::user()->businessProfile->id) {
            abort(403);
        }

        return view('provider.appointments.show', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment, $status = null)
    {
        if (Auth::user()->role !== 'provider') {
            abort(403);
        }

        if ($appointment->business_id !== Auth::user()->businessProfile->id) {
            abort(403);
        }

        // If status is passed in the URL, use it; otherwise, get it from the request
        $newStatus = $status ?? $request->input('status');
        
        // Validate the status
        if (!in_array($newStatus, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            return redirect()->back()->with('error', 'Invalid status provided.');
        }

        // Update the appointment status
        $appointment->update(['status' => $newStatus]);

        return redirect()->route('provider.appointments.show', $appointment)
            ->with('success', 'Appointment status updated successfully.');
    }
} 