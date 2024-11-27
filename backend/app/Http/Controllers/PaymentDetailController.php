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
                'amount' => 'required|numeric|min:0',
                'payment_status' => 'required|integer',
                'payment_date' => [
                    'required_if:payment_status,2',
                    'nullable',
                    'date',
                ],
                'payment_mode' => 'nullable|integer',
                'product_service_id' => 'required|exists:product_service_details,id',
                'customer_id' => 'required|exists:customer_details,id',
            ], [
                'payment_date.required_if' => 'The payment date field is required when payment status is paid.',
            ]);
            $paymentDetail = PaymentDetail::create($validatedData);

            if ($validatedData['payment_status'] == 2) {
                $productService = ProductServiceDetail::findOrFail($validatedData['product_service_id']);
                $customer = CustomerDetail::findOrFail($validatedData['customer_id']);
    
                $phoneNumber = '91' . $customer->phone_number;
                $message = "Your payment of ₹{$validatedData['amount']} has been received for Service ID: {$productService->service_id}. Thank you for your payment!";
    
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
                'amount' => 'required|numeric|min:0',
                'payment_status' => 'required|integer',
                'payment_date' => [
                    'required_if:payment_status,2',
                    'nullable',
                    'date',
                ],
                'payment_mode' => 'nullable|integer',
                'product_service_id' => 'required|exists:product_service_details,id',
                'customer_id' => 'required|exists:customer_details,id',
            ], [
                'payment_date.required_if' => 'The payment date field is required when payment status is paid.',
            ]);
            $paymentDetail = PaymentDetail::findOrFail($id);
            $paymentDetail->update($validatedData);
            if ($validatedData['payment_status'] == 2) {
                $productService = ProductServiceDetail::findOrFail($validatedData['product_service_id']);
                $customer = CustomerDetail::findOrFail($validatedData['customer_id']);
    
                $phoneNumber = '91' . $customer->phone_number;
                $message = "Your payment of ₹{$validatedData['amount']} has been received for Service ID: {$productService->service_id}. Thank you for your payment!";
    
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
