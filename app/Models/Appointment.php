<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Service;
use App\Models\BusinessProfile;
use App\Models\User;
use App\Models\Upload;

class Appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'service_id',
        'business_profile_id',
        'start_time',
        'end_time',
        'status',
        'notes'
    ];

    protected $dates = [
        'start_time',
        'end_time',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function businessProfile()
    {
        return $this->belongsTo(BusinessProfile::class, 'business_profile_id');
    }

    public function business()
    {
        return $this->businessProfile();
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }
}