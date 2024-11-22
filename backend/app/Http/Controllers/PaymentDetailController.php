<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetail;
use Illuminate\Http\Request;

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
            ]);
            $paymentDetail = PaymentDetail::create($validatedData);

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
            ]);
            $paymentDetail = PaymentDetail::findOrFail($id);
            $paymentDetail->update($validatedData);
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
