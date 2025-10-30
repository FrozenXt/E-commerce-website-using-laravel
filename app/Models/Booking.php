<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'device_brand',
        'device_model',
        'issue_description',
        'booking_date',
        'booking_time',
        'status',
        'notes'
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}