@extends('layouts.client')

@section('content')

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('client.appointments.store') }}" class="space-y-6">
                    @csrf

                    <!-- Business Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Select a Business</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($businesses as $business)
                                <div class="business-card relative bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden cursor-pointer transition-all duration-200 hover:shadow-md {{ old('business_id') == $business->id ? 'ring-2 ring-orange-500' : '' }}"
                                     data-business-id="{{ $business->id }}">
                                    <div class="p-4">
                                        <div class="flex items-center">
                                            @if($business->logo_path)
                                                <img src="{{ asset('storage/' . $business->logo_path) }}" 
                                                     alt="{{ $business->business_name }}"
                                                     class="w-16 h-16 rounded-full object-cover border border-gray-200">
                                            @else
                                                <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <h3 class="text-lg font-medium text-gray-900">{{ $business->business_name }}</h3>
                                                <p class="text-sm text-gray-500">{{ ucwords($business->business_type) }}</p>
                                                @if($business->address)
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                                        {{ $business->address }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Business Hours Preview -->
                                        <div class="mt-3 pt-3 border-t border-gray-100">
                                            <div class="flex justify-between items-center text-sm">
                                                <span class="font-medium text-gray-700">Hours:</span>
                                                <span class="text-gray-600">
                                                    @php
                                                        // Get the day name in lowercase (e.g., 'monday', 'tuesday')
                                                        $today = strtolower(now()->format('l'));
                                                        
                                                        // Get the business hours for today
                                                        $hours = $business->business_hours[$today] ?? null;
                                                        
                                                        // Display the hours in green or 'Closed Today' in red
                                                        if ($hours && $hours['enabled'] ?? false) {
                                                            $openTime = \Carbon\Carbon::createFromFormat('H:i', $hours['open'])->format('g:i A');
                                                            $closeTime = \Carbon\Carbon::createFromFormat('H:i', $hours['close'])->format('g:i A');
                                                            echo "<span class='text-green-600 font-medium'>{$openTime} - {$closeTime}</span>";
                                                        } else {
                                                            echo "<span class='text-red-600 font-medium'>Closed Today</span>";
                                                        }
                                                    @endphp
                                                </span>
                                            </div>
                                        </div>
                                        <!-- View Hours Button -->
                                        <div class="mt-3 pt-3 border-t border-gray-100 text-right">
                                            <button type="button" 
                                                    class="text-sm text-orange-600 hover:text-orange-800 font-medium"
                                                    onclick="showBusinessHours({{ $business->id }}, {{ json_encode($business->business_hours) }})">
                                                View Full Hours
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Hidden radio input for form submission -->
                                    <input type="radio" name="business_id" value="{{ $business->id }}" 
                                           id="business_{{ $business->id }}" 
                                           class="sr-only"
                                           {{ old('business_id') == $business->id ? 'checked' : '' }} required>
                                </div>
                            @endforeach
                        </div>
                        @error('business_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Service Selection -->
                    <div>
                        <label for="service_id" class="block text-sm font-medium text-gray-700">Select a Service</label>
                        <select id="service_id" name="service_id" class="mt-1 block w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm" required disabled>
                            @foreach($businesses as $business)
                                @if($business->services && $business->services->count() > 0)
                                    <optgroup label="{{ $business->business_name }} ({{ $business->business_type }})" class="business-services-{{ $business->id }}" style="display: none;">
                                        @foreach($business->services as $service)
                                            @if($service->is_visible)
                                                <option value="{{ $service->id }}" data-duration="{{ $service->duration }}" data-price="{{ $service->price }}">
                                                    {{ $service->name }}
                                                    ({{ $service->duration }} min - ₱{{ number_format($service->price, 2) }})
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @endif
                            @endforeach
                        </select>
                        @error('service_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date Selection -->
                    <div class="mt-6">
                        <label for="date" class="block text-sm font-medium text-gray-700">Select Date</label>
                        <input type="date" id="date" name="date"
                                min="{{ date('Y-m-d') }}"
                                value="{{ old('date', date('Y-m-d')) }}"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                                required>
                        @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Time Selection -->
                    <div>
                        <label for="time" class="block text-sm font-medium text-gray-700">Select Time</label>
                        <select id="time" name="time" required
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                            <option value="">Choose a time...</option>
                            @foreach(range(8, 20) as $hour)
                                @foreach(['00', '30'] as $minute)
                                    <option value="{{ sprintf('%02d:%s', $hour, $minute) }}"
                                            {{ old('time') == sprintf('%02d:%s', $hour, $minute) ? 'selected' : '' }}>
                                        {{ sprintf('%02d:%s', $hour > 12 ? $hour - 12 : $hour, $minute) }} 
                                        {{ $hour >= 12 ? 'PM' : 'AM' }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Appointment Summary -->
                    <div class="bg-gray-50 p-4 rounded-lg mt-6" id="appointment-summary" style="display: none;">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Appointment Summary</h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Service</dt>
                                <dd class="mt-1 text-sm text-gray-900" id="summary-service">-</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                <dd class="mt-1 text-sm text-gray-900" id="summary-duration">-</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Date & Time</dt>
                                <dd class="mt-1 text-sm text-gray-900" id="summary-datetime">-</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Price</dt>
                                <dd class="mt-1 text-sm text-gray-900" id="summary-price">-</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                            Book Appointment
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Business Hours Modal -->
    <div id="business-hours-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="business-hours-title">Business Hours</h3>
                <button type="button" onclick="document.getElementById('business-hours-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-2" id="business-hours-list">
                <!-- Hours will be populated by JavaScript -->
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" onclick="document.getElementById('business-hours-modal').classList.add('hidden')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle business selection and services -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const businessCards = document.querySelectorAll('.business-card');
            const serviceSelect = document.getElementById('service_id');
            const dateInput = document.getElementById('date');
            const timeSelect = document.getElementById('time');
            const summaryService = document.getElementById('summary-service');
            const summaryDuration = document.getElementById('summary-duration');
            const summaryPrice = document.getElementById('summary-price');
            const summaryDateTime = document.getElementById('summary-datetime');
            const appointmentSummary = document.getElementById('appointment-summary');

            // Function to update the appointment summary
            function updateSummary() {
                const selectedService = serviceSelect.options[serviceSelect.selectedIndex];
                const selectedDate = dateInput.value;
                const selectedTime = timeSelect.value;

                if (selectedService?.value && selectedDate && selectedTime) {
                    summaryService.textContent = selectedService.textContent.split('(')[0].trim();
                    summaryDuration.textContent = `${selectedService.dataset.duration} minutes`;
                    summaryPrice.textContent = `₱${parseFloat(selectedService.dataset.price).toFixed(2)}`;
                    summaryDateTime.textContent = new Date(selectedDate + 'T' + selectedTime).toLocaleString('en-US', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                        hour12: true
                    });
                    appointmentSummary.style.display = 'block';
                } else {
                    appointmentSummary.style.display = 'none';
                }
            }

            // Handle business card selection
            businessCards.forEach(card => {
                card.addEventListener('click', function() {
                    const businessId = this.dataset.businessId;
                    const radioInput = this.querySelector('input[type="radio"]');
                    
                    // Update visual selection
                    businessCards.forEach(c => c.classList.remove('ring-2', 'ring-orange-500'));
                    this.classList.add('ring-2', 'ring-orange-500');
                    
                    // Update the radio input
                    radioInput.checked = true;
                    
                    // Update service dropdown
                    serviceSelect.value = '';
                    serviceSelect.disabled = false;

                    // Hide all optgroups
                    const optgroups = serviceSelect.getElementsByTagName('optgroup');
                    Array.from(optgroups).forEach(group => {
                        group.style.display = 'none';
                    });

                    // Show services for selected business
                    const businessServices = document.querySelector(`.business-services-${businessId}`);
                    if (businessServices) {
                        businessServices.style.display = 'block';
                    }
                    
                    // Trigger change event to update the summary
                    serviceSelect.dispatchEvent(new Event('change'));
                });
            });
            
            // If we have a previously selected business (from validation), simulate a click on its card
            const selectedBusinessId = '{{ old('business_id') }}';
            if (selectedBusinessId) {
                const selectedCard = document.querySelector(`.business-card[data-business-id="${selectedBusinessId}"]`);
                if (selectedCard) {
                    selectedCard.click();
                    
                    // If we also have a previously selected service, select it
                    const selectedServiceId = '{{ old('service_id') }}';
                    if (selectedServiceId) {
                        setTimeout(() => {
                            serviceSelect.value = selectedServiceId;
                            serviceSelect.dispatchEvent(new Event('change'));
                        }, 100);
                    }
                }
            }

            // Add event listeners for form elements
            serviceSelect.addEventListener('change', updateSummary);
            dateInput.addEventListener('change', updateSummary);
            timeSelect.addEventListener('change', updateSummary);
            
            // Initialize service select state
            serviceSelect.options[0].textContent = 'Select a business first...';
            serviceSelect.disabled = true;
        });

        // Function to show business hours in modal
        function showBusinessHours(businessId, businessHours) {
            const modal = document.getElementById('business-hours-modal');
            const title = document.getElementById('business-hours-title');
            const hoursList = document.getElementById('business-hours-list');
            
            // Set the business name in the title
            const businessCard = document.querySelector(`.business-card[data-business-id="${businessId}"]`);
            const businessName = businessCard ? businessCard.querySelector('h3').textContent : 'Business';
            title.textContent = `${businessName} Hours`;
            
            // Clear previous hours
            hoursList.innerHTML = '';
            
            // Add each day's hours
            const days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
            const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            
            days.forEach((day, index) => {
                const dayHours = businessHours[day];
                const dayElement = document.createElement('div');
                dayElement.className = 'flex justify-between items-center py-2 border-b border-gray-100';
                
                const dayName = document.createElement('span');
                dayName.className = 'font-medium text-gray-700';
                dayName.textContent = dayNames[index];
                
                const hours = document.createElement('span');
                hours.className = 'text-gray-600';
                
                if (dayHours && dayHours.enabled) {
                    const openTime = new Date(`2000-01-01T${dayHours.open}`).toLocaleTimeString('en-US', {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true
                    });
                    const closeTime = new Date(`2000-01-01T${dayHours.close}`).toLocaleTimeString('en-US', {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true
                    });
                    hours.textContent = `${openTime} - ${closeTime}`;
                    hours.className += ' text-green-600 font-medium';
                } else {
                    hours.textContent = 'Closed';
                    hours.className += ' text-red-600';
                }
                
                dayElement.appendChild(dayName);
                dayElement.appendChild(hours);
                hoursList.appendChild(dayElement);
            });
            
            // Show the modal
            modal.classList.remove('hidden');
        }
    </script>
@endsection
