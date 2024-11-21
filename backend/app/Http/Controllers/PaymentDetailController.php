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

    public function fetchPaymentDetails(){
        $paymentDetails = PaymentDetail::join('customer_details', 'payment_details.customer_id', '=', 'customer_details.id')
            ->join('product_service_details', 'payment_details.product_service_id', '=', 'product_service_details.id')
            ->join('payment_modes', 'payment_details.payment_mode', '=', 'payment_modes.id')
            ->join('payment_statuses', 'payment_details.payment_status', '=', 'payment_statuses.id')
            ->select(
                'payment_details.*', 
                'payment_modes.mode as payment_mode',
                'payment_statuses.payment_status',
                'customer_details.name as customer_name', 
                'product_service_details.service_id', 
                'product_service_details.product_type', 
                'product_service_details.product_name'
            )
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
        //
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
