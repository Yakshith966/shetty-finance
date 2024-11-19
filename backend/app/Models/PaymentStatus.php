<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    public function productServiceDetails()
    {
        return $this->hasMany(ProductServiceDetail::class, 'service_status');
    }

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class, 'payment_status');
    }
}
