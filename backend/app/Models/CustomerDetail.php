<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    use HasFactory;

    protected $table = 'customer_details';
    
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'alternate_phone_number',
    ];

    public function productServiceDetails()
    {
        return $this->hasMany(ProductServiceDetail::class, 'customer_id');
    }
    public function payments()
    {
        return $this->hasMany(PaymentDetail::class, 'customer_id');
    }
}
