<?php

namespace App\Http\Controllers;

use App\Exports\PaymentDetailExport;
use App\Jobs\SendServiceStatusJob;
use App\Models\CustomerDetail;
use App\Models\PaymentDetail;
use App\Models\PaymentStatus;
use App\Models\ProductServiceDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaymentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function fetchPaymentStatus(){
        $paymentStatusData = PaymentStatus::all();
        return response()->json($paymentStatusData);
    }

    public function fetchPaymentDetails(){
        $paymentDetails = PaymentDetail::join('customer_details', 'payment_details.customer_id', '=', 'customer_details.id')
            ->join('product_service_details', 'payment_details.product_service_id', '=', 'product_service_details.id')
            ->leftJoin('payment_modes', 'payment_details.payment_mode', '=', 'payment_modes.id')
            ->join('payment_statuses', 'payment_details.payment_status', '=', 'payment_statuses.id')
            ->select(
                'payment_details.*', 
                'payment_details.payment_status as payment_status_id',
                'payment_modes.mode as payment_mode',
                'payment_statuses.payment_status',
                'customer_details.name as customer_name', 
                'product_service_details.service_id', 
                'product_service_details.product_type', 
                'product_service_details.product_name'
            )
            // ->where('payment_details.payment_status', '=', 2)
            ->orderBy('payment_details.id', 'desc')
            ->get();
        
        if ($paymentDetails->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No payment details found.',
            ], 404);
        }
        
        return response()->json($paymentDetails);
    }

    public function paymentDetailExcelExport(Request $request)
    {
        $excelData = $request->input('reportData');
        if (!is_array($excelData)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }
        return Excel::download(new PaymentDetailExport($excelData), 'PaymentDetailsReport.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'repair_cost' => 'required|numeric|min:0',
                'paid_amount' => [
                    'required_if:payment_status,2|required_if:payment_status,3',
                    'nullable',
                    'numeric',
                    'min:0',
                ],
                'advance_amount' => [
                    'required_if:payment_status,3',
                    'nullable',
                    'numeric',
                    'min:0',
                ],
                'remaining_amount' => [
                    'required_if:payment_status,3',
                    'nullable',
                    'numeric',
                    'min:0',
                ],
                'payment_status' => 'required|integer|in:1,2,3,4',
                'payment_date' => [
                    'required_if:payment_status,2|required_if:payment_status,3',
                    'nullable',
                    'date',
                ],
                'payment_mode' => 'nullable|integer',
                'product_service_id' => 'required|exists:product_service_details,id',
                'customer_id' => 'required|exists:customer_details,id',
            ], [
                'repair_cost.required' => 'The repair cost field is required.',
                'paid_amount.required_if' => 'The paid amount field is required for the selected payment status.',
                'advance_amount.required_if' => 'The advance amount field is required for the selected payment status.',
                'remaining_amount.required_if' => 'The remaining amount field is required for the selected payment status.',
                'payment_date.required_if' => 'The payment date field is required for the selected payment status.',
            ]);
            if ($validatedData['payment_status'] == 3 && $validatedData['remaining_amount'] == 0) {
                $validatedData['payment_status'] = 2;
                $validatedData['remaining_amount'] = null;
                $validatedData['advance_amount'] = null;
            }

            // Ensure amounts align with the logic
            if ($validatedData['payment_status'] == 3) {
                $totalPaid = $validatedData['advance_amount'] + $validatedData['remaining_amount'];
                if ($totalPaid != $validatedData['repair_cost']) {
                    return response()->json([
                        'message' => 'The sum of advance amount and paid amount must equal the repair cost.',
                    ], 422);
                }
            }
            // dd($validatedData);


            // return response()->json([$validatedData]);

            $paymentDetail = PaymentDetail::create($validatedData);

            // Send a notification if the status is paid
            if ($validatedData['payment_status'] == 2) {
                $productService = ProductServiceDetail::findOrFail($validatedData['product_service_id']);
                $customer = CustomerDetail::findOrFail($validatedData['customer_id']);

                $phoneNumber = '91' . $customer->phone_number;
                $message = "Your payment of ₹{$validatedData['repair_cost']} has been received for Service ID: {$productService->service_id}. Thank you for your payment!";

                SendServiceStatusJob::dispatch($phoneNumber, $message);
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment details stored successfully.',
                'data' => $paymentDetail,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updatePaymentDetails(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'repair_cost' => 'required|numeric|min:0',
                'paid_amount' => [
                    'required_if:payment_status,2|required_if:payment_status,3',
                    'nullable',
                    'numeric',
                    'min:0',
                ],
                'advance_amount' => [
                    'required_if:payment_status,3',
                    'nullable',
                    'numeric',
                    'min:0',
                ],
                'remaining_amount' => [
                    'required_if:payment_status,3',
                    'nullable',
                    'numeric',
                    'min:0',
                ],
                'payment_status' => 'required|integer|in:1,2,3,4',
                'payment_date' => [
                    'required_if:payment_status,2|required_if:payment_status,3',
                    'nullable',
                    'date',
                ],
                'payment_mode' => 'nullable|integer',
                'product_service_id' => 'required|exists:product_service_details,id',
                'customer_id' => 'required|exists:customer_details,id',
            ], [
                'repair_cost.required' => 'The repair cost field is required.',
                'paid_amount.required_if' => 'The paid amount field is required for the selected payment status.',
                'advance_amount.required_if' => 'The advance amount field is required for the selected payment status.',
                'remaining_amount.required_if' => 'The remaining amount field is required for the selected payment status.',
                'payment_date.required_if' => 'The payment date field is required for the selected payment status.',
            ]);

            $paymentDetail = PaymentDetail::findOrFail($id);

            // Handle payment status logic
            if ($validatedData['payment_status'] == 3 && $validatedData['remaining_amount'] == 0) {
                $validatedData['payment_status'] = 2;
                $validatedData['remaining_amount'] = null;
                $validatedData['advance_amount'] = null;
            }

            if ($validatedData['payment_status'] == 3) {
                // Ensure amounts align with the logic for partial payments
                $totalPaid = $validatedData['advance_amount'] + $validatedData['remaining_amount'];
                if ($totalPaid != $validatedData['repair_cost']) {
                    return response()->json([
                        'message' => 'The sum of advance amount and remaining amount must equal the repair cost.',
                    ], 422);
                }
            } elseif ($validatedData['payment_status'] == 2) {
                // If payment status is "Paid" (2), clear remaining and advance amounts
                $validatedData['remaining_amount'] = null;
                $validatedData['advance_amount'] = null;
            }

            // Update payment details
            $paymentDetail->update($validatedData);

            // Send a notification if the status is paid
            if ($validatedData['payment_status'] == 2) {
                $productService = ProductServiceDetail::findOrFail($validatedData['product_service_id']);
                $customer = CustomerDetail::findOrFail($validatedData['customer_id']);

                $phoneNumber = '91' . $customer->phone_number;
                $message = "Your payment of ₹{$validatedData['repair_cost']} has been received for Service ID: {$productService->service_id}. Thank you for your payment!";

                SendServiceStatusJob::dispatch($phoneNumber, $message);
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment details updated successfully.',
                'data' => $paymentDetail,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getPaymentDetails(Request $request)
    {
        try {
            $paymentDetail = PaymentDetail::where('product_service_id', $request->service_id)
                ->where('customer_id', $request->customer_id)
                ->first();

            return response()->json([
                'exists' => $paymentDetail ? true : false,
                'data' => $paymentDetail,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'exists' => false,
                'message' => 'An error occurred while fetching payment details.',
                'error' => $e->getMessage(),
            ], 200); 
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentDetail $paymentDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentDetail $paymentDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentDetail $paymentDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentDetail $paymentDetail)
    {
        //
    }
}
