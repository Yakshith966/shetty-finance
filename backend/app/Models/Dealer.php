<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'alternative_phone_number',
        'address',
    ];

     public function dealerDetails()
    {
        return $this->hasMany(DealerDetails::class, 'dealer_id');
    }


}
