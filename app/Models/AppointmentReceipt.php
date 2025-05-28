<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentReceipt extends Model
{
    protected $fillable = [
        'appointment_id',
        'file_path',
        'original_filename',
        'status',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
