<?php if (isset($component)) { $__componentOriginal19c4e483e5c865bc7c9b689f46d76ac7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal19c4e483e5c865bc7c9b689f46d76ac7 = $attributes; } ?>
<?php $component = App\View\Components\ClientLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('client-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ClientLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                <!-- Total Appointments -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Appointments</p>
                            <p class="text-lg font-semibold text-gray-700"><?php echo e($totalAppointments); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Appointments -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Upcoming Appointments</p>
                            <p class="text-lg font-semibold text-gray-700"><?php echo e($upcomingAppointments); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Completed Appointments -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Completed</p>
                            <p class="text-lg font-semibold text-gray-700"><?php echo e($completedAppointments); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Quick Book -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Quick Book</p>
                            </div>
                        </div>
                        <a href="<?php echo e(route('client.appointments.create')); ?>" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Upcoming Appointments Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Upcoming Appointments</h2>
                        <a href="<?php echo e(route('client.appointments.index')); ?>" class="text-orange-600 hover:text-orange-700 text-sm font-medium">
                            View All →
                        </a>
                    </div>

                    <?php if($nextAppointments->count() > 0): ?>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $nextAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center space-x-4">
                                        <?php if($appointment->service->businessProfile->logo_path): ?>
                                            <img src="<?php echo e(Storage::url($appointment->service->businessProfile->logo_path)); ?>" 
                                                 alt="Business Logo" 
                                                 class="w-12 h-12 rounded-full object-cover">
                                        <?php else: ?>
                                            <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 7a2 2 0 11-4 0 2 2 0 014 0zM20 14a2 2 0 11-4 0 2 2 0 014 0zM8 14a2 2 0 11-4 0 2 2 0 014 0zM4 21h16" />
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <h3 class="font-medium text-gray-900"><?php echo e($appointment->service->name); ?></h3>
                                            <p class="text-sm text-gray-500"><?php echo e($appointment->service->businessProfile->business_name); ?></p>
                                            <p class="text-sm text-gray-500">
                                                <?php echo e(\Carbon\Carbon::parse($appointment->start_time)->format('l, F j, Y')); ?>

                                                <span class="mx-1">•</span>
                                                <?php echo e(\Carbon\Carbon::parse($appointment->start_time)->format('g:i A')); ?>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="px-3 py-1 text-sm rounded-full 
                                            <?php if($appointment->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                            <?php elseif($appointment->status === 'confirmed'): ?> bg-blue-100 text-blue-800
                                            <?php elseif($appointment->status === 'completed'): ?> bg-green-100 text-green-800
                                            <?php elseif($appointment->status === 'cancelled'): ?> bg-red-100 text-red-800
                                            <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                                            <?php echo e(ucfirst($appointment->status)); ?>

                                        </span>
                                        <a href="<?php echo e(route('client.appointments.show', $appointment)); ?>" 
                                           class="text-orange-600 hover:text-orange-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No upcoming appointments</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by booking your first appointment.</p>
                            <div class="mt-6">
                                <a href="<?php echo e(route('client.appointments.create')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Book Appointment
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal19c4e483e5c865bc7c9b689f46d76ac7)): ?>
<?php $attributes = $__attributesOriginal19c4e483e5c865bc7c9b689f46d76ac7; ?>
<?php unset($__attributesOriginal19c4e483e5c865bc7c9b689f46d76ac7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal19c4e483e5c865bc7c9b689f46d76ac7)): ?>
<?php $component = $__componentOriginal19c4e483e5c865bc7c9b689f46d76ac7; ?>
<?php unset($__componentOriginal19c4e483e5c865bc7c9b689f46d76ac7); ?>
<?php endif; ?>
<?php /**PATH D:\Operating\SaaS App\salon-scheduler\resources\views/client/dashboard.blade.php ENDPATH**/ ?>