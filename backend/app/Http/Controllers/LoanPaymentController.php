<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LoanPaymentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'month' => 'required|date',
            'interest_paid' => 'required|numeric|min:0',
            'principal_paid' => 'nullable|numeric|min:0',
            'penalty' => 'nullable|numeric|min:0',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $loan = Loan::findOrFail($validated['loan_id']);

        // Check if month_year is beyond loan end_date
        if ($validated['month'] > $loan->end_date) {
            throw ValidationException::withMessages([
                'month' => ['Month cannot be after the loan end date.'],
            ]);
        }

        DB::transaction(function () use ($validated, $loan) {
            // Create payment
            LoanPayment::create([
                'loan_id' => $validated['loan_id'],
                'month_year' => $validated['month'],
                'interest_paid' => $validated['interest_paid'],
                'principal_paid' => $validated['principal_paid'] ?? 0,
                'penalty' => $validated['penalty'] ?? 0,
                'payment_date' => $validated['payment_date'],
                'notes' => $validated['notes'],
            ]);

            // Recalculate and update total principal paid
            $totalPrincipalPaid = LoanPayment::where('loan_id', $loan->id)->sum('principal_paid');
            $loan->update(['principal_paid' => $totalPrincipalPaid]);
        });

        return response()->json(['message' => 'Payment recorded and principal updated.']);
    }
}
