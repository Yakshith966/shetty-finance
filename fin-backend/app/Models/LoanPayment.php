<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan_id',
        'month_year',
        'interest_paid',
        'principal_paid',
        'penalty',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    // 🔗 Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
