<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ProviderServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role !== 'provider') abort(403);
        $services = Service::where('business_id', Auth::user()->businessProfile->id ?? null)->get();
        return view('provider.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'provider') abort(403);
        return view('provider.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            \Log::info('Raw request data', [
                'all_data' => $request->all(),
                'user' => Auth::user()
            ]);

            $user = Auth::user();
            \Log::info('User info', [
                'id' => $user->id,
                'role' => $user->role,
                'has_business_profile' => $user->businessProfile !== null
            ]);

            if ($user->role !== 'provider') {
                \Log::error('Unauthorized access attempt', [
                    'user_role' => $user->role
                ]);
                abort(403, 'Unauthorized access');
            }

            $businessProfile = $user->businessProfile;
            if (!$businessProfile) {
                \Log::info('Creating new business profile');
                $businessProfile = new BusinessProfile([
                    'business_name' => $user->name . ' Salon',
                    'user_id' => $user->id,
                    'is_active' => true
                ]);
                $businessProfile->save();
                $user->businessProfile()->save($businessProfile);
                \Log::info('Business profile created', [
                    'profile_id' => $businessProfile->id
                ]);
            }

            $serviceData = [
                'name' => $request->input('name'),
                'price' => $request->input('price', 0),
                'duration' => $request->input('duration'),
                'description' => $request->input('description'),
                'is_visible' => $request->has('is_visible'),
                'business_id' => $businessProfile->id,
                'tags' => $request->input('tags', [])
            ];

            \Log::info('Service data', $serviceData);

            $service = Service::create($serviceData);
            \Log::info('Service created', [
                'service_id' => $service->id
            ]);

            return redirect()->route('provider.services.index')->with('success', 'Service created successfully!');

        } catch (\Exception $e) {
            \Log::error('Error creating service', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        if (Auth::user()->role !== 'provider') abort(403);
        if ($service->business_id !== (Auth::user()->businessProfile->id ?? null)) abort(403);
        return view('provider.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        if (Auth::user()->role !== 'provider') abort(403);
        if ($service->business_id !== (Auth::user()->businessProfile->id ?? null)) abort(403);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'is_visible' => 'nullable|boolean',
        ]);
        $validated['is_visible'] = $request->has('is_visible');
        $service->update($validated);
        return redirect()->route('provider.services.index')->with('success', 'Service updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if (Auth::user()->role !== 'provider') abort(403);
        if ($service->business_id !== (Auth::user()->businessProfile->id ?? null)) abort(403);
        $service->delete();
        return redirect()->route('provider.services.index')->with('success', 'Service deleted!');
    }
}
