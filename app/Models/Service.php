<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'business_profile_id', 'name', 'description', 'price', 'is_visible', 'duration'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_visible' => 'boolean'
    ];

    public function businessProfile()
    {
        return $this->belongsTo(BusinessProfile::class, 'business_profile_id');
    }
    
    public function business()
    {
        return $this->businessProfile();
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
} 