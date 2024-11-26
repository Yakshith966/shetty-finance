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
        try {
           
            $customers = CustomerDetail::all();

           
            return response()->json([
                'success' => true,
                'data' => $customers,
            ], 200);
        } catch (\Exception $e) {
           
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch customer details.',
                'error' => $e->getMessage(),
            ], 500);
        }
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
    public function update(Request $request, $id)
{
    try {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Name is required
            'phone_number' => 'required|integer|max:10', // Phone number is required
            'email' => 'nullable|email|max:255', // Email is optional
            'alternate_phone_number' => 'nullable|string|max:10', // Alternate phone is optional
        ]);

        // Find the customer by ID
        $customer = CustomerDetail::findOrFail($id);

        // Update customer details
        $customer->update($validated);

        // Return success response
        return response()->json([
            'message' => 'Customer updated successfully',
            'data' => $customer,
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed.',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while updating the customer.',
            'error' => $e->getMessage(),
        ], 500);
    }
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
