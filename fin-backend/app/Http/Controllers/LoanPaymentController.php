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
            'month_year' => 'required|date',
            'interest_paid' => 'required|numeric|min:0',
            'principal_paid' => 'nullable|numeric|min:0',
            'penalty' => 'nullable|numeric|min:0',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $loan = Loan::findOrFail($validated['loan_id']);

        if ($validated['month_year'] > $loan->end_date) {
            throw ValidationException::withMessages([
                'month_year' => ['Month cannot be after the loan end date.'],
            ]);
        }

        $totalPrincipalPaid = LoanPayment::where('loan_id', $loan->id)->sum('principal_paid');
        $remainingPrincipal = $loan->amount_given - $totalPrincipalPaid;

        $incomingPrincipal = $validated['principal_paid'] ?? 0;

        if ($incomingPrincipal > $remainingPrincipal) {
            throw ValidationException::withMessages([
                'principal_paid' => ["You're trying to pay ₹{$incomingPrincipal}, but only ₹{$remainingPrincipal} remains on the principal."],
            ]);
        }

        DB::transaction(function () use ($validated, $loan) {
            // 1. Record the new payment
            LoanPayment::create([
                'loan_id' => $validated['loan_id'],
                'month_year' => $validated['month_year'],
                'interest_paid' => $validated['interest_paid'],
                'principal_paid' => $validated['principal_paid'] ?? 0,
                'penalty' => $validated['penalty'] ?? 0,
                'payment_date' => $validated['payment_date'],
                'notes' => $validated['notes'],
            ]);

            // 2. Update principal_paid in the loan
            $totalPrincipalPaid = LoanPayment::where('loan_id', $loan->id)->sum('principal_paid');
            $loan->principal_paid = $totalPrincipalPaid;

            // 3. Calculate total interest paid
            $totalInterestPaid = LoanPayment::where('loan_id', $loan->id)->sum('interest_paid');

            // 4. Dynamically calculate expected interest (based on monthly interest * months)
            $monthlyInterest = $loan->monthly_interest ?? 0; // you must have this
            $loanDurationMonths = \Carbon\Carbon::parse($loan->start_date)
                ->diffInMonths(\Carbon\Carbon::parse($loan->end_date));
            $expectedInterest = $monthlyInterest * $loanDurationMonths;

            $remainingPrincipal = $loan->principal_amount - $totalPrincipalPaid;

            // 5. Close the loan if all dues are cleared
            if ($remainingPrincipal <= 0 && $totalInterestPaid >= $expectedInterest) {
                $loan->is_closed = true;
                $loan->status = 'closed';
                $loan->principal_cleared_date = $validated['payment_date'];
            }

            // Save loan updates
            $loan->save();
        });

        return response()->json(['message' => 'Payment recorded and principal updated.']);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'month_year' => 'required|date',
            'interest_paid' => 'required|numeric|min:0',
            'principal_paid' => 'nullable|numeric|min:0',
            'penalty' => 'nullable|numeric|min:0',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $loan = Loan::findOrFail($validated['loan_id']);
        $payment = LoanPayment::findOrFail($id);

        if ($validated['month_year'] > $loan->end_date) {
            throw ValidationException::withMessages([
                'month_year' => ['Month cannot be after the loan end date.'],
            ]);
        }

        // Exclude current payment from total before update
        $totalPrincipalPaid = LoanPayment::where('loan_id', $loan->id)
            ->where('id', '!=', $payment->id)
            ->sum('principal_paid');

        $remainingPrincipal = $loan->amount_given - $totalPrincipalPaid;
        $incomingPrincipal = $validated['principal_paid'] ?? 0;

        if ($incomingPrincipal > $remainingPrincipal) {
            throw ValidationException::withMessages([
                'principal_paid' => ["You're trying to pay ₹{$incomingPrincipal}, but only ₹{$remainingPrincipal} remains on the principal."],
            ]);
        }

        DB::transaction(function () use ($payment, $validated, $loan) {
            // 1. Update the payment
            $payment->update([
                'month_year' => $validated['month_year'],
                'interest_paid' => $validated['interest_paid'],
                'principal_paid' => $validated['principal_paid'] ?? 0,
                'penalty' => $validated['penalty'] ?? 0,
                'payment_date' => $validated['payment_date'],
                'notes' => $validated['notes'],
            ]);

            // 2. Recalculate loan principal
            $totalPrincipalPaid = LoanPayment::where('loan_id', $loan->id)->sum('principal_paid');
            $loan->principal_paid = $totalPrincipalPaid;

            // 3. Recalculate interest
            $totalInterestPaid = LoanPayment::where('loan_id', $loan->id)->sum('interest_paid');
            $monthlyInterest = $loan->monthly_interest ?? 0;
            $loanDurationMonths = \Carbon\Carbon::parse($loan->start_date)
                ->diffInMonths(\Carbon\Carbon::parse($loan->end_date));
            $expectedInterest = $monthlyInterest * $loanDurationMonths;

            // 4. Close loan if conditions met
            $remainingPrincipal = $loan->principal_amount - $totalPrincipalPaid;
            if ($remainingPrincipal <= 0 && $totalInterestPaid >= $expectedInterest) {
                $loan->is_closed = true;
                $loan->status = 'closed';
                $loan->principal_cleared_date = $validated['payment_date'];
            }

            $loan->save();
        });

        return response()->json(['message' => 'Payment updated successfully.']);
    }

}
