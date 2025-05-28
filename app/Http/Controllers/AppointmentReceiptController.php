<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Appointment;
use App\Models\AppointmentReceipt;

class AppointmentReceiptController extends Controller
{
    public function create(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403);
        }
        return view('appointments.receipt_upload', compact('appointment'));
    }

    public function store(Request $request, Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403);
        }
        $request->validate([
            'receipt' => 'required|file|mimes:jpeg,png,jpg,pdf|max:8192',
        ]);
        $file = $request->file('receipt');
        $path = $file->store('receipts', 'public');
        $receipt = AppointmentReceipt::create([
            'appointment_id' => $appointment->id,
            'file_path' => $path,
            'original_filename' => $file->getClientOriginalName(),
            'status' => 'pending',
        ]);
        return redirect()->route('appointments.show', $appointment)->with('success', 'Receipt uploaded!');
    }

    public function show(AppointmentReceipt $receipt)
    {
        // Only the client or provider can view
        $user = Auth::user();
        if ($user->id !== $receipt->appointment->user_id && ($user->role !== 'provider' || $user->businessProfile->id !== $receipt->appointment->business_id)) {
            abort(403);
        }
        return response()->file(storage_path('app/public/' . $receipt->file_path));
    }

    public function verify(AppointmentReceipt $receipt)
    {
        $user = Auth::user();
        if ($user->role !== 'provider' || $user->businessProfile->id !== $receipt->appointment->business_id) {
            abort(403);
        }
        $receipt->status = 'verified';
        $receipt->save();
        
        return back()->with('success', 'Receipt verified successfully!');
    }

    public function reject(AppointmentReceipt $receipt)
    {
        $user = Auth::user();
        if ($user->role !== 'provider' || $user->businessProfile->id !== $receipt->appointment->business_id) {
            abort(403);
        }
        $receipt->status = 'rejected';
        $receipt->save();
        
        return back()->with('success', 'Receipt rejected successfully.');
    }
}
