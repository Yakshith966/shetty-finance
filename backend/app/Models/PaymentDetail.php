<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_service_id',
        'amount',
        'payment_status',
        'payment_mode',
        'payment_date',
    ];

    // Define the relationship with ServiceStatus
    public function serviceStatus()
    {
        return $this->belongsTo(ServiceStatus::class, 'service_status');
    }

    // Define the relationship with CustomerDetail
    public function customer()
    {
        return $this->belongsTo(CustomerDetail::class, 'customer_id');
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode');
    }

    // Define the relationship with CustomerDetail
    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status');
    }
}
