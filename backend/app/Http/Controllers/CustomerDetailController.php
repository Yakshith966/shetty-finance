<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerDetailRequest;
use App\Models\CustomerDetail;
use Illuminate\Http\Request;

class CustomerDetailController extends Controller
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
    public function store(StoreCustomerDetailRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $customerDetail = CustomerDetail::create($validatedData);
    
            return response()->json([
                'message' => 'Customer detail created successfully!',
                'data' => $customerDetail
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the customer detail.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerDetail  $customerDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerDetail $customerDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerDetail  $customerDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerDetail $customerDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerDetail  $customerDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerDetail $customerDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerDetail  $customerDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerDetail $customerDetail)
    {
        //
    }
}
