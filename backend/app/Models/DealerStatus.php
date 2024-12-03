<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerStatus extends Model
{
    use HasFactory;
    protected $table = 'dealers_status';
    protected $fillable = ['status'];

    public function dealerDetails()
    {
        return $this->hasMany(DealerDetails::class, 'status_id');
    }
}
