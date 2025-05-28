<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{

    public function index()
    {
        $businessId = auth()->user()->businessProfile->id;
        
        $appointments = \DB::table('appointments')
            ->join('users', 'appointments.user_id', '=', 'users.id')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->leftJoin('business_profiles', 'appointments.business_profile_id', '=', 'business_profiles.id')
            ->where('appointments.business_profile_id', $businessId)
            ->select([
                'appointments.*',
                'users.name as user_name',
                'users.email as user_email',
                'services.name as service_name',
                'services.price as service_price',
                'business_profiles.business_name'
            ])
            ->orderByDesc('appointments.start_time')
            ->paginate(10);

            $appointments->getCollection()->transform(function ($item) {
            $item->start_time = \Carbon\Carbon::parse($item->start_time);
            $item->end_time = \Carbon\Carbon::parse($item->end_time);
            $item->created_at = \Carbon\Carbon::parse($item->created_at);
            $item->updated_at = \Carbon\Carbon::parse($item->updated_at);
            return $item;
        });

        return view('provider.appointments.index', ['appointments' => $appointments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('is_visible', true)->get();
        $selectedService = $services->first();
        $businessHours = null;
        
        if ($selectedService) {
            $businessHours = $selectedService->businessProfile->businessHours()
                ->orderBy('day_of_week')
                ->get()
                ->map(function($hour) {
                    return [
                        'day_of_week' => $hour->day_of_week,
                        'closed' => $hour->closed,
                        'open_time' => $hour->open_time,
                        'close_time' => $hour->close_time
                    ];
                });
        }
        
        return view('appointments.create', compact('services', 'businessHours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'notes' => 'nullable|string',
        ]);

        $service = \App\Models\Service::find($validated['service_id']);
        $business = $service->businessProfile;
        $businessHours = $business->businessHours()->where('day_of_week', \Carbon\Carbon::parse($validated['start_time'])->dayOfWeek)->first();
        if (!$businessHours || $businessHours->closed) {
            return back()->withInput()->withErrors(['start_time' => 'The business is closed on this day.']);
        }
        $start = \Carbon\Carbon::parse($validated['start_time']);
        $end = \Carbon\Carbon::parse($validated['end_time']);
        $open = \Carbon\Carbon::parse($start->format('Y-m-d') . ' ' . $businessHours->open_time);
        $close = \Carbon\Carbon::parse($start->format('Y-m-d') . ' ' . $businessHours->close_time);
        if ($start->lt($open) || $end->gt($close)) {
            return back()->withInput()->withErrors(['start_time' => 'The selected time is outside of business hours.']);
        }

        $conflict = \App\Models\Appointment::where('business_id', $service->business_id)
            ->where(function($q) use ($start, $end) {
                $q->where(function($q2) use ($start, $end) {
                    $q2->where('start_time', '<', $end)
                        ->where('end_time', '>', $start);
                });
            })
            ->whereIn('status', ['pending', 'accepted', 'confirmed'])
            ->exists();
        if ($conflict) {
            return back()->withInput()->withErrors(['start_time' => 'This time slot is already booked. Please choose another time.']);
        }

        $validated['user_id'] = auth()->id();
        $validated['business_id'] = $service->business_id;
        $validated['status'] = 'pending';

        $appointment = Appointment::create($validated);
        
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('provider.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $services = Service::where('is_visible', true)->get();
        return view('appointments.edit', compact('appointment', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment, $status = null)
    {
        $newStatus = $status ?? $request->input('status');
        
        // Validate the status
        if (!in_array($newStatus, ['pending', 'confirmed', 'completed', 'cancelled', 'accepted'])) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Invalid status provided.'], 422);
            }
            return redirect()->back()->with('error', 'Invalid status provided.');
        }

        $appointment->update(['status' => $newStatus]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Appointment status updated successfully.',
                'redirect' => route('provider.appointments.show', $appointment->id)
            ]);
        }

        return redirect()->route('provider.appointments.show', $appointment)
            ->with('success', 'Appointment status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
    
    public function updateStatus(Appointment $appointment, Request $request, $status)
    {
        $validStatuses = ['pending', 'accepted', 'rejected', 'completed', 'cancelled'];
        
        if (!in_array($status, $validStatuses)) {
            return back()->with('error', 'Invalid status.');
        }
        
        $appointment->update(['status' => $status]);
        
        return back()->with('success', 'Appointment status updated successfully.');
    }
}
