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
    public function renew(Request $request, $loanId)
    {
        $validated = $request->validate([
            'extra_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'loan_months' => 'required|integer|min:1',
            'interest_rate' => 'required|numeric|min:0',
        ]);

        return DB::transaction(function () use ($request, $loanId, $validated) {
            $oldLoan = Loan::findOrFail($loanId);

            $remaining = $oldLoan->principal_amount - $oldLoan->principal_paid;
            $extra = $request->input('extra_amount', 0);
            $totalNewLoanAmount = $remaining + $extra;

            // Mark old loan as renewed and closed
            $oldLoan->update([
                'status' => 'renewed',
                'is_closed' => true,
            ]);

            // Create new loan
            $newLoan = Loan::create([
                'member_id' => $oldLoan->member_id,
                'principal_amount' => $totalNewLoanAmount,
                'amount_given' => $totalNewLoanAmount,
                'carried_forward_amount' => $remaining,
                'extra_amount' => $extra,
                'loan_months' => $validated['loan_months'],
                'interest_deducted_upfront' => 0,
                'interest_rate' => $validated['interest_rate'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'original_loan_id' => $oldLoan->id,
                'status' => 'active',
            ]);

            return response()->json([
                'message' => 'Loan renewed successfully.',
                'new_loan' => $newLoan,
            ]);
        });
    }
    public function details($loanId)
    {
        $loan = Loan::with([
            'member',
            'originalLoan',
            'renewedLoans',
            'payments'
        ])->findOrFail($loanId);

        return response()->json([
            'data' => $loan
        ]);
    }
    public function show($id)
    {
        $loan = Loan::with('member', 'payments')->findOrFail($id);

        return response()->json([
            'loan' => $loan
        ]);
    }
    public function closeLoan(Loan $loan)
    {
        if ($loan->is_closed || $loan->status === 'renewed') {
            return response()->json(['message' => 'Loan already closed or renewed.'], 400);
        }

        // Calculate total principal already paid
        $totalPrincipalPaid = $loan->payments()->sum('principal_paid');
        $remainingPrincipal = $loan->principal_amount - $totalPrincipalPaid;

        // Create a final payment record to clear the principal
        $loan->payments()->create([
            'month_year' => now()->startOfMonth(),
            'payment_date' => now(),
            'interest_paid' => 0,
            'principal_paid' => $remainingPrincipal,
            'penalty' => 0,
            'notes' => 'Auto-payment on loan closure'
        ]);

        // Update loan as closed
        $loan->update([
            'is_closed' => true,
            'payment_cleared_date' => now()
        ]);

        return response()->json(['message' => 'Loan closed successfully.']);
    }
}
