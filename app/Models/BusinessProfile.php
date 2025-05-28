<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    protected $fillable = [
        'user_id',
        'business_name',
        'business_type',
        'description',
        'contact_email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'logo_path',
        'is_active',
        'business_hours'
    ];

    protected $casts = [
        'operating_hours' => 'array',
        'business_hours' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'business_profile_id')
            ->where('is_visible', true);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'business_profile_id');
    }

    public function businessHours()
    {
        return $this->hasMany(BusinessHour::class, 'business_profile_id');
    }
} 