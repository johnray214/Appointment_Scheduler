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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">My Appointments</h2>
                        <a href="<?php echo e(route('client.appointments.create')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Book New Appointment
                        </a>
                    </div>

                    <?php if($appointments->count() > 0): ?>
                        <div class="space-y-6">
                            <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center justify-between p-6 bg-gray-50 rounded-lg">
                                    <div class="flex items-center space-x-6">
                                        <?php if($appointment->service && $appointment->service->businessProfile && $appointment->service->businessProfile->logo_path): ?>
                                            <img src="<?php echo e(Storage::url($appointment->service->businessProfile->logo_path)); ?>" 
                                                 alt="Business Logo" 
                                                 class="w-16 h-16 rounded-full object-cover">
                                        <?php else: ?>
                                            <div class="w-16 h-16 rounded-full bg-orange-100 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 7a2 2 0 11-4 0 2 2 0 014 0zM20 14a2 2 0 11-4 0 2 2 0 014 0zM8 14a2 2 0 11-4 0 2 2 0 014 0zM4 21h16" />
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">
                                                <?php echo e($appointment->service->name ?? 'Service Not Available'); ?>

                                            </h3>
                                            <?php if($appointment->service && $appointment->service->businessProfile): ?>
                                                <p class="text-sm text-gray-500">
                                                    <?php echo e($appointment->service->businessProfile->business_name); ?>

                                                    (<?php echo e(ucwords($appointment->service->businessProfile->business_type)); ?>)
                                                </p>
                                            <?php endif; ?>
                                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <?php echo e(\Carbon\Carbon::parse($appointment->start_time)->format('l, F j, Y')); ?>

                                            </div>
                                            <div class="mt-1 flex items-center text-sm text-gray-500">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <?php echo e(\Carbon\Carbon::parse($appointment->start_time)->format('g:i A')); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end space-y-3">
                                        <span class="px-3 py-1 text-sm rounded-full 
                                            <?php if($appointment->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                            <?php elseif($appointment->status === 'confirmed'): ?> bg-blue-100 text-blue-800
                                            <?php elseif($appointment->status === 'completed'): ?> bg-green-100 text-green-800
                                            <?php elseif($appointment->status === 'cancelled'): ?> bg-red-100 text-red-800
                                            <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                                            <?php echo e(ucfirst($appointment->status)); ?>

                                        </span>
                                        <div class="flex items-center space-x-2">
                                            <a href="<?php echo e(route('client.appointments.show', $appointment)); ?>" 
                                               class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                                View Details
                                            </a>
                                            <?php if($appointment->status !== 'cancelled' && $appointment->status !== 'completed' && !$appointment->start_time->isPast()): ?>
                                                <form action="<?php echo e(route('client.appointments.cancel', $appointment)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" 
                                                            onclick="return confirm('Are you sure you want to cancel this appointment?')"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                        Cancel
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="mt-6">
                            <?php echo e($appointments->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No appointments found</h3>
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
<?php /**PATH D:\Operating\SaaS App\salon-scheduler\resources\views/client/appointments/index.blade.php ENDPATH**/ ?>