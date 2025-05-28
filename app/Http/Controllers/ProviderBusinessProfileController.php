<?php

namespace App\Http\Controllers;

use App\Models\BusinessProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProviderBusinessProfileController extends Controller
{
    public function showSetup()
    {
        try {
            $user = Auth::user();
            if ($user->businessProfile) {
                return redirect()->route('provider.dashboard')
                    ->with('error', 'You already have a business profile.');
            }
            return view('provider.business-profile.setup');
        } catch (\Exception $e) {
            logger()->error('Error in business profile setup view: ' . $e->getMessage());
            return back()->with('error', 'Unable to load setup form. Please try again.');
        }
    }

    public function edit()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                logger()->error('No authenticated user');
                return redirect()->route('login');
            }
            
            logger()->info('User ID: ' . $user->id);
            logger()->info('User Role: ' . $user->role);
            
            $businessProfile = $user->businessProfile;
            if (!$businessProfile) {
                logger()->error('No business profile found for user ' . $user->id);
                return redirect()->route('provider.business-profile.setup')
                    ->with('error', 'Please set up your business profile first.');
            }
            
            logger()->info('Business Profile ID: ' . $businessProfile->id);
            logger()->info('Business Name: ' . $businessProfile->business_name);

            return view('provider.business-profile.edit', compact('businessProfile'));
        } catch (\Exception $e) {
            logger()->error('Error in business profile edit: ' . $e->getMessage());
            return back()->with('error', 'Unable to load business profile. Please try again.');
        }
    }

    public function update(Request $request)
    {
        try {
            $businessProfile = Auth::user()->businessProfile;
            
            $validated = $request->validate([
                'business_name' => 'required|string|max:255',
                'business_type' => 'required|string|in:Salon,Barber Shop',
                'description' => 'required|string',
                'contact_email' => ['required', 'email', Rule::unique('business_profiles', 'contact_email')->ignore($businessProfile->id)],
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos', 'public');
                $validated['logo_path'] = $logoPath;
            }

            $businessProfile->update($validated);

            return back()->with('success', 'Business profile updated successfully!');
        } catch (\Exception $e) {
            logger()->error('Error updating business profile: ' . $e->getMessage());
            return back()->withInput()
                ->withErrors(['error' => 'Failed to update business profile. Please try again.']);
        }
    }

    public function setup(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'business_name' => 'required|string|max:255',
                'business_type' => 'required|string|in:Salon,Barber Shop',
                'description' => 'required|string',
                'contact_email' => ['required', 'email', Rule::unique('business_profiles', 'contact_email')],
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $user = Auth::user();
            
            if (!$user->businessProfile) {
                $businessProfile = new BusinessProfile([
                    'user_id' => $user->id,
                    'business_name' => $validatedData['business_name'],
                    'business_type' => $validatedData['business_type'],
                    'description' => $validatedData['description'],
                    'contact_email' => $validatedData['contact_email'],
                    'phone' => $validatedData['phone'],
                    'address' => $validatedData['address'],
                    'is_active' => true
                ]);

                if ($request->hasFile('logo')) {
                    $logoPath = $request->file('logo')->store('logos', 'public');
                    $businessProfile->logo_path = $logoPath;
                }

                $businessProfile->save();

                return redirect()->route('provider.dashboard')
                    ->with('success', 'Business profile created successfully.');
            }

            return redirect()->route('provider.dashboard')
                ->with('error', 'Business profile already exists.');

        } catch (\Exception $e) {
            logger()->error('Error in business profile setup: ' . $e->getMessage());
            return back()->with('error', 'Unable to set up business profile. Please try again.');
        }
    }
}
