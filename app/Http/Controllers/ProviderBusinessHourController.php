<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessHour;
use App\Models\BusinessProfile;

class ProviderBusinessHourController extends Controller
{
    public function edit()
    {
        $business = Auth::user()->businessProfile;
        $hours = $business->businessHours()->orderBy('day_of_week')->get()->keyBy('day_of_week');
        $days = collect(range(0,6))->mapWithKeys(function($d) use ($hours, $business) {
            return [$d => $hours[$d] ?? new BusinessHour(['business_id' => $business->id, 'day_of_week' => $d, 'closed' => true])];
        });
        return view('provider.business_hours.edit', [
            'days' => $days
        ]);
    }

    public function update(Request $request)
    {
        $business = Auth::user()->businessProfile;
        $data = $request->validate([
            'hours' => 'required|array',
            'hours.*.open_time' => 'nullable|date_format:H:i',
            'hours.*.close_time' => 'nullable|date_format:H:i|after:hours.*.open_time',
            'hours.*.closed' => 'nullable|boolean',
        ]);
        foreach ($data['hours'] as $day => $values) {
            $hour = BusinessHour::firstOrNew([
                'business_id' => $business->id,
                'day_of_week' => $day,
            ]);
            $hour->open_time = $values['closed'] ? null : $values['open_time'];
            $hour->close_time = $values['closed'] ? null : $values['close_time'];
            $hour->closed = $values['closed'] ?? false;
            $hour->save();
        }
        return back()->with('success', 'Business hours updated successfully!');
    }
}
