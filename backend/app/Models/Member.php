<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'email',
        'phone_number',
        'alt_phone_number',
        'address',
        'document_proof_id',
    ];
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
