<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductServiceDetailRequest;
use App\Models\CustomerDetail;
use App\Models\ProductServiceDetail;
use Illuminate\Http\Request;

class ProductServiceDetailController extends Controller
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
            
             $validated = $request->validate([
                 'customer_name' => 'required|string|max:255',
                 'phone' => 'required|string|max:15',
                 'email' => 'nullable|email|max:255',
                 'altPhone' => 'nullable|string|max:15',
                 'productType' => 'required|string|max:255',
                 'productName' => 'required|string|max:255',
                 'serialNumber' => 'required|string|max:255',
                 'model' => 'required|string|max:255',
                 'issueDescription' => 'nullable|string',
                 'date' => 'required|date',
                 'collectedItems' => 'nullable|string',
                 'status' => 'required',
             ]);
     
             
             $customer = CustomerDetail::firstOrCreate(
                 ['phone_number' => $validated['phone']],
                 [
                     'name' => $validated['customer_name'],
                     'email' => $validated['email'],
                     'phone_number' => $validated['phone'],
                     'alternate_phone_number' => $validated['altPhone']
                 ]
             );
     
             
             $productServiceDetail = ProductServiceDetail::create([
                 'customer_id' => $customer->id,
                 'product_type' => $validated['productType'],
                 'product_name' => $validated['productName'],
                 'serial_number' => $validated['serialNumber'],
                 'model_number' => $validated['model'],
                 'description' => $validated['issueDescription'],
                 'other_collected_item' => $validated['collectedItems'],
                 'product_recieved_date' => $validated['date'],
                 'service_status' => $validated['status'],
             ]);
     
           
             return response()->json([
                 'message' => 'Product Service Detail saved successfully.',
                 'data' => $productServiceDetail,
             ], 201);
     
         } catch (\Illuminate\Validation\ValidationException $e) {
           
             return response()->json([
                 'message' => 'Validation failed.',
                 'errors' => $e->errors(),
             ], 422);
     
         } catch (\Exception $e) {
           
             return response()->json([
                 'message' => 'An error occurred while saving the data.',
                 'error' => $e->getMessage(),
             ], 500);
         }
     }
     

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductServiceDetail  $productServiceDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ProductServiceDetail $productServiceDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductServiceDetail  $productServiceDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductServiceDetail $productServiceDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductServiceDetail  $productServiceDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductServiceDetail $productServiceDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductServiceDetail  $productServiceDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductServiceDetail $productServiceDetail)
    {
        //
    }
}
