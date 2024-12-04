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
        'repair_cost',
        'advance_amount',
        'paid_amount',
        'remaining_amount',
        'payment_status',
        'payment_mode',
        'payment_date',
    ];

    // Define the relationship with CustomerDetail
    public function customer()
    {
        return $this->belongsTo(CustomerDetail::class, 'customer_id');
    }

    public function productService(){
        return $this->belongsTo(ProductServiceDetail::class, 'product_service_id');
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
