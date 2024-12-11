<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'dealer_id',
        'payment_mode',
        'product_description',
        'status_id',
        'payment_status_id',
        'amount',
        'amount_received_date',
    ];

    /**
     * Relationship with ProductServiceDetails model.
     */
    public function productServiceDetail()
    {
        return $this->belongsTo(ProductServiceDetail::class, 'service_id', 'id');
    }

    /**
     * Relationship with Dealer model.
     */
    public function dealer()
    {
        return $this->belongsTo(Dealer::class, 'dealer_id');
    }

    /**
     * Relationship with DealerStatus model.
     */
    public function status()
    {
        return $this->belongsTo(DealerStatus::class, 'status_id');
    }

    /**
     * Relationship with PaymentStatus model.
     */
    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id');
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode');
    }
}
