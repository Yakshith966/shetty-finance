<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'member_id' => 'required|exists:members,id',
            'principal_amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'loan_months' => 'required|integer|min:1',
            'interest_deducted_upfront' => 'nullable|numeric|min:0',
            'amount_given' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Additional business rule validation (e.g. loan duration)
        $start = \Carbon\Carbon::parse($request->start_date);
        $end = \Carbon\Carbon::parse($request->end_date);
        $months = $end->diffInMonths($start);

        if ($months < 1) {
            return response()->json([
                'error' => 'Loan duration must be at least 1 month.'
            ], 422);
        }

        // Store the loan
        $loan = Loan::create([
            'member_id' => $request->member_id,
            'principal_amount' => $request->principal_amount,
            'interest_rate' => $request->interest_rate,
            'loan_months' => $months,
            'interest_deducted_upfront' => $request->interest_deducted_upfront ?? 0,
            'amount_given' => $request->amount_given,
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
        ]);

        return response()->json([
            'message' => 'Loan disbursed successfully',
            'loan' => $loan,
        ], 201);
    }
    public function index()
    {
        $loans = Loan::with(['payments', 'member'])->get();
        // Optional: Use pagination instead of get()
        // $loans = Loan::with(['payments', 'member'])->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Loans fetched successfully',
            'data' => $loans
        ], 200);
    }
    
}
