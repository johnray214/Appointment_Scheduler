<?php if (isset($component)) { $__componentOriginal18ad219ff812ef43f05a7d8a7c618959 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18ad219ff812ef43f05a7d8a7c618959 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.provider-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('provider-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="<?php echo e(route('provider.appointments.index')); ?>" class="inline-flex items-center text-sm text-orange-600 hover:text-orange-700">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Appointments
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">Appointment Details</h2>
                            <p class="mt-1 text-sm text-gray-600">View the details of this appointment below.</p>
                        </div>
                        <span class="px-3 py-1 text-sm rounded-full 
                            <?php if($appointment->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                            <?php elseif($appointment->status === 'confirmed'): ?> bg-blue-100 text-blue-800
                            <?php elseif($appointment->status === 'completed'): ?> bg-green-100 text-green-800
                            <?php elseif($appointment->status === 'cancelled'): ?> bg-red-100 text-red-800
                            <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                            <?php echo e(ucfirst($appointment->status)); ?>

                        </span>
                    </div>

                    <div class="mt-6 border-t border-gray-200">
                        <dl class="divide-y divide-gray-200">
                            <!-- Customer Information -->
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Customer</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="font-medium"><?php echo e($appointment->user->name); ?></p>
                                            <p class="text-gray-500"><?php echo e($appointment->user->email); ?></p>
                                        </div>
                                    </div>
                                </dd>
                            </div>

                            <!-- Service Information -->
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Service</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <p class="font-medium"><?php echo e($appointment->service->name); ?></p>
                                    <p class="text-gray-500">Duration: <?php echo e($appointment->service->duration); ?> minutes</p>
                                    <p class="text-gray-500">Price: ₱<?php echo e(number_format($appointment->service->price, 2)); ?></p>
                                </dd>
                            </div>

                            <!-- Date and Time -->
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Date & Time</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <?php echo e(\Carbon\Carbon::parse($appointment->start_time)->format('l, F j, Y')); ?>

                                    </div>
                                    <div class="flex items-center mt-1">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <?php echo e(\Carbon\Carbon::parse($appointment->start_time)->format('g:i A')); ?> - 
                                        <?php echo e(\Carbon\Carbon::parse($appointment->end_time)->format('g:i A')); ?>

                                    </div>
                                </dd>
                            </div>

                            <!-- Notes -->
                            <?php if($appointment->notes): ?>
                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Notes</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <?php echo e($appointment->notes); ?>

                                    </dd>
                                </div>
                            <?php endif; ?>

                            <!-- Actions -->
                            <?php if($appointment->status !== 'cancelled' && !$appointment->start_time->isPast()): ?>
                                <div class="pt-6 space-x-3">
                                    <?php if($appointment->status === 'pending'): ?>
                                        <form action="<?php echo e(route('provider.appointments.status.update', ['appointment' => $appointment->id, 'status' => 'confirmed'])); ?>" method="POST" class="inline" data-appointment-form>
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('POST'); ?>
                                            <button type="submit" 
                                                    class="inline-flex items-center px-2 sm:px-4 py-1.5 sm:py-2 border border-transparent text-xs sm:text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Confirm Appointment
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if($appointment->status === 'confirmed'): ?>
                                        <form action="<?php echo e(route('provider.appointments.status.update', ['appointment' => $appointment->id, 'status' => 'completed'])); ?>" method="POST" class="inline" data-appointment-form>
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('POST'); ?>
                                            <button type="submit" 
                                                    class="inline-flex items-center px-2 sm:px-4 py-1.5 sm:py-2 border border-transparent text-xs sm:text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Mark as Completed
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if($appointment->status !== 'completed' && $appointment->status !== 'cancelled'): ?>
                                        <form action="<?php echo e(route('provider.appointments.status.update', ['appointment' => $appointment->id, 'status' => 'cancelled'])); ?>" method="POST" class="inline" data-appointment-form>
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('POST'); ?>
                                            <button type="submit" 
                                                    onclick="return confirm('Are you sure you want to cancel this appointment?')"
                                                    class="inline-flex items-center px-2 sm:px-4 py-1.5 sm:py-2 border border-transparent text-xs sm:text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Cancel Appointment
                                            </button>
                                        </form>
                                        
                                        <?php $__env->startPush('scripts'); ?>
                                            <?php echo app('Illuminate\Foundation\Vite')(['resources/js/appointment-show.js']); ?>
                                        <?php $__env->stopPush(); ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18ad219ff812ef43f05a7d8a7c618959)): ?>
<?php $attributes = $__attributesOriginal18ad219ff812ef43f05a7d8a7c618959; ?>
<?php unset($__attributesOriginal18ad219ff812ef43f05a7d8a7c618959); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18ad219ff812ef43f05a7d8a7c618959)): ?>
<?php $component = $__componentOriginal18ad219ff812ef43f05a7d8a7c618959; ?>
<?php unset($__componentOriginal18ad219ff812ef43f05a7d8a7c618959); ?>
<?php endif; ?>
<?php /**PATH D:\Operating\SaaS App\salon-scheduler\resources\views/provider/appointments/show.blade.php ENDPATH**/ ?>