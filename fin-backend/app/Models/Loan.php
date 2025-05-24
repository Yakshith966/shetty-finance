<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'principal_amount',
        'principal_paid',
        'principal_cleared_date',
        'carried_forward_amount',
        'extra_amount',
        'interest_rate',
        'loan_months',
        'status',
        'interest_deducted_upfront',
        'amount_given',
        'start_date',
        'end_date',
        'is_closed',
        'original_loan_id',
    ];

    protected $casts = [
        'is_closed' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($loan) {
            $loan->loan_number = self::generateLoanNumber();
        });
    }

    protected static function generateLoanNumber()
    {
        // Example: LN202405180001
        $prefix = 'LN' . now()->format('Ymd');
        $latestLoan = self::where('loan_number', 'like', "$prefix%")
            ->orderBy('loan_number', 'desc')
            ->first();

        if (!$latestLoan) {
            return $prefix . '0001';
        }

        $lastNumber = (int) substr($latestLoan->loan_number, -4);
        return $prefix . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    }

    // 🔗 Customer
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // 🔁 Payments
    public function payments()
    {
        return $this->hasMany(LoanPayment::class);
    }

    // 🔁 Original loan (if renewed)
    public function originalLoan()
    {
        return $this->belongsTo(Loan::class, 'original_loan_id');
    }

    // 🔁 Renewed loans (children)
    public function renewedLoans()
    {
        return $this->hasMany(Loan::class, 'original_loan_id');
    }
}
