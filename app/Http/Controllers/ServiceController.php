<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $businessId = auth()->user()->businessProfile->id;
        $services = Service::where('business_profile_id', $businessId)
            ->orderBy('name')
            ->paginate(10);

        return view('provider.services.index', compact('services'));
    }

    public function create()
    {
        return view('provider.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:15',
            'is_visible' => 'boolean'
        ]);

        $businessId = auth()->user()->businessProfile->id;
        $service = Service::create([
            'business_profile_id' => $businessId,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'is_visible' => $request->has('is_visible')
        ]);

        return redirect()->route('provider.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('provider.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:15',
            'is_visible' => 'boolean'
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        $service->update($validated);

        return redirect()->route('provider.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        // Check if service has any appointments
        if ($service->appointments()->exists()) {
            return redirect()->route('provider.services.index')
                ->with('error', 'Cannot delete service with existing appointments.');
        }

        $service->delete();

        return redirect()->route('provider.services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
