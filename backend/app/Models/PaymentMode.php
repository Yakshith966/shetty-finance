<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    use HasFactory;

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class, 'payment_mode');
    }
    public function dealerDetails()
    {
        return $this->hasMany(DealerDetails::class, 'payment_mode');
    }
}
