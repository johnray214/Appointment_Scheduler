<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment;

class AppointmentPolicy
{
    public function view(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id || 
               $user->id === $appointment->service->businessProfile->user_id;
    }

    public function cancel(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id && 
               !$appointment->start_time->isPast() &&
               $appointment->status !== 'cancelled';
    }

    public function update(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->service->businessProfile->user_id;
    }
}
