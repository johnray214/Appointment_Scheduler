<?php

namespace App\Http\Controllers;

use App\Models\BusinessProfile;
use Illuminate\Http\Request;

class BusinessHoursController extends Controller
{
    public function edit()
    {
        $businessProfile = auth()->user()->businessProfile;

        if (!$businessProfile) {
            return redirect()->route('provider.business-profile.setup')
                ->with('error', 'Please set up your business profile first.');
        }

        $businessHours = $businessProfile->business_hours ?? [
            'monday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => true],
            'tuesday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => true],
            'wednesday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => true],
            'thursday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => true],
            'friday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => true],
            'saturday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => true],
            'sunday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => false],
        ];

        return view('provider.business-hours-setup', compact('businessHours'));
    }

    public function store(Request $request)
    {
        $businessProfile = auth()->user()->businessProfile;

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $businessHours = [];

        foreach ($days as $day) {
            $businessHours[$day] = [
                'open' => $request->input("days.{$day}.open", '09:00'),
                'close' => $request->input("days.{$day}.close", '17:00'),
                'enabled' => (bool) $request->input("days.{$day}.enabled", false)
            ];
        }

        $businessProfile->update([
            'business_hours' => $businessHours,
        ]);

        return back()->with('success', 'Business hours set successfully.');
    }

    public function update(Request $request)
    {
        $businessProfile = auth()->user()->businessProfile;

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $businessHours = [];

        foreach ($days as $day) {
            $businessHours[$day] = [
                'open' => $request->input("hours.{$day}.open", '09:00'),
                'close' => $request->input("hours.{$day}.close", '17:00'),
                'closed' => (bool) $request->input("hours.{$day}.closed", false)
            ];
        }

        $businessProfile->update([
            'business_hours' => $businessHours,
        ]);

        return back()->with('success', 'Business hours updated successfully!');
    }
}
