<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProviderDashboardController;
use App\Http\Controllers\BusinessHoursController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\ProviderBusinessProfileController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'provider') {
            return redirect()->route('provider.dashboard');
        } elseif (auth()->user()->role === 'client') {
            return redirect()->route('client.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    Route::get('/debug/service-usage', function () {
        $controller = new \App\Http\Controllers\ProviderDashboardController();
        $businessId = auth()->user()->businessProfile->id;
        return response()->json($controller->getServiceUsageData($businessId));
    })->middleware(['auth', 'role:provider']);

    Route::middleware([\App\Http\Middleware\ProviderMiddleware::class])
        ->prefix('provider')
        ->name('provider.')
        ->group(function () {
            Route::get('/business-profile/setup', [ProviderBusinessProfileController::class, 'showSetup'])
                ->name('business-profile.setup')
                ->middleware(\App\Http\Middleware\EnsureNoBusinessProfile::class);
            Route::post('/business-profile/setup', [ProviderBusinessProfileController::class, 'setup'])
                ->name('business-profile.store')
                ->middleware(\App\Http\Middleware\EnsureNoBusinessProfile::class);

            Route::middleware(\App\Http\Middleware\EnsureProviderHasBusinessProfile::class)->group(function () {
                Route::get('/dashboard', [ProviderDashboardController::class, 'index'])->name('dashboard');
                Route::resource('appointments', AppointmentController::class);
                Route::post('/appointments/{appointment}/status/{status}', [AppointmentController::class, 'update'])
                    ->name('appointments.status.update')
                    ->where('status', 'pending|confirmed|completed|cancelled');
                Route::resource('services', ServiceController::class);
                Route::get('/business-hours/setup', [BusinessHoursController::class, 'edit'])
                    ->name('business-hours.edit');
                Route::post('/business-hours/setup', [BusinessHoursController::class, 'store'])
                    ->name('business-hours.store');
                Route::put('/business-hours', [BusinessHoursController::class, 'update'])
                    ->name('business-hours.update');
                Route::get('/business-profile', [ProviderBusinessProfileController::class, 'edit'])
                    ->name('business-profile.edit');
                Route::put('/business-profile', [ProviderBusinessProfileController::class, 'update'])
                    ->name('business-profile.update');
                Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
                Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
                Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

            });
    });

    Route::middleware(['auth', 'verified'])
        ->prefix('client')
        ->name('client.')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class . ':client')
        ->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');
            Route::resource('appointments', \App\Http\Controllers\Client\AppointmentController::class);
            Route::post('/appointments/{appointment}/cancel', [\App\Http\Controllers\Client\AppointmentController::class, 'cancel'])
                ->name('appointments.cancel');
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


});

require __DIR__.'/auth.php';


