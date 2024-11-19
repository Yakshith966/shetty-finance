<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductServiceDetailRequest;
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
    public function store(StoreProductServiceDetailRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $productServiceDetail = ProductServiceDetail::create($validatedData);
    
            return response()->json([
                'message' => 'Product service detail created successfully!',
                'data' => $productServiceDetail
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the product service detail.',
                'error' => $e->getMessage()
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
