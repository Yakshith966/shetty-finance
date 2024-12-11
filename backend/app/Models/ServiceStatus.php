<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceStatus extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'service_statuses';

    // Define the relationship with ProductServiceDetail
    public function productServiceDetails()
    {
        return $this->hasMany(ProductServiceDetail::class, 'service_status');
    }
}
