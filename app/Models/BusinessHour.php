<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
    protected $fillable = [
        'business_id',
        'day_of_week',
        'open_time',
        'close_time',
        'closed',
    ];

    public function businessProfile()
    {
        return $this->belongsTo(BusinessProfile::class, 'business_id');
    }
}
