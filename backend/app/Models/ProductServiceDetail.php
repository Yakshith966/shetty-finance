<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductServiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'customer_id',
        'product_type',
        'product_name',
        'serial_number',
        'model_number',
        'description',
        'other_collected_item',
        'product_recieved_date',
        'service_status',
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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($productServiceDetail) {
            // Generate service_id as "SRV<Number>"
            $latestService = self::latest('id')->lockForUpdate()->first(); // Ensures row locking for concurrency safety
            $nextId = $latestService ? intval(substr($latestService->service_id, 3)) + 1 : 1;

            // Set the service_id without leading zeros
            $productServiceDetail->service_id = 'SRV' . $nextId;
        });
    }

}
