<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->isAdmin())
                        <h3 class="text-lg font-medium">Admin Dashboard</h3>
                        <p>Welcome, {{ auth()->user()->name }}! You are logged in as an admin.</p>
                        <!-- Admin-specific content here -->
                    @else
                        <h3 class="text-lg font-medium">Client Dashboard</h3>
                        <p>Welcome, {{ auth()->user()->name }}! You are logged in as a client.</p>
                        <!-- Client-specific content here -->
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
