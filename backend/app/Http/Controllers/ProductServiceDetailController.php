<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductServiceDetailRequest;
use App\Jobs\SendServiceStatusJob;
use App\Models\CustomerDetail;
use App\Models\ProductServiceDetail;
use App\Models\ServiceStatus;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class ProductServiceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $query = ProductServiceDetail::with([
                'customer',
                'paymentDetails.paymentStatus',
                'latestDealerDetail'
            ]);
            if ($request->has('service_status')) {
                $query->where('service_status', $request->service_status);
            }
            if ($request->has('payment_status')) {
                $query->whereHas('paymentDetails.paymentStatus', function ($q) use ($request) {
                    $q->where('status', $request->payment_status);
                });
            }
            $query->orderBy('id', 'desc');
            $details = $query->get();
            return response()->json([
                'success' => true,
                'data' => $details,
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database query error: ' . $e->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
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

    public function store(Request $request)
    {
        try {
            $validated = $request->validate(
                [
                    'customer_name' => 'required|string|max:255',
                    'phone' => [
                        'required',
                        'integer',
                        'regex:/^\d{10}$/',
                    ],
                    'email' => [
                        'nullable',
                        'email',
                        'max:255',
                        Rule::unique('customer_details', 'email')->ignore($request->selectedCustomer),
                    ],
                    'altPhone' => [
                        'nullable',
                        'integer',
                        'regex:/^\d{10}$/',
                    ],
                    'productType' => 'required|string|max:255',
                    'productName' => 'required|string|max:255',
                    'serialNumber' => 'nullable|string|max:255',
                    'model' => 'nullable|string|max:255',
                    'date' => 'required|date',
                    'issueDescription' => 'required',
                    'collectedItems' => 'nullable|string',
                    'status' => 'required',
                    'selectedCustomer' => 'nullable|exists:customer_details,id',
                ],
                [
                    'phone.regex' => 'The phone number must be exactly 10 digits.',
                    'altPhone.regex' => 'The Alternative number must be exactly 10 digits.',
                ], 
            );
            if (!is_null($request->selectedCustomer)) {

                $customer = CustomerDetail::find($request->selectedCustomer);
            } else {

                $customer = CustomerDetail::create([
                    'name' => $validated['customer_name'],
                    'email' => $validated['email'],
                    'phone_number' => $validated['phone'],
                    'alternate_phone_number' => $validated['altPhone']
                ]);
            }
            $productServiceDetail = ProductServiceDetail::create([
                'customer_id' => $customer->id,
                'product_type' => $validated['productType'],
                'product_name' => $validated['productName'],
                'serial_number' => $validated['serialNumber'],
                'model_number' => $validated['model'],
                'description' => $validated['issueDescription'],
                'other_collected_item' => $validated['collectedItems'],
                'product_received_date' => $validated['date'],
                'service_status' => $validated['status'],
            ]);
            if ($validated['status'] == 1 || $validated['status'] == 3) {
                $phoneNumber = '91' . $productServiceDetail->customer->phone_number;
                $status = ServiceStatus::find($validated['status'])->status;
            
                // Determine the message based on the status
                if ($validated['status'] == 1) {
                    $message = "Your product '{$productServiceDetail->product_name}' has been $status. The Service ID is {$productServiceDetail->service_id}. Please contact us for further queries. Thank you for choosing our service! 😊";

                } elseif ($validated['status'] == 3) {
                    $message = "The service for your '{$productServiceDetail->product_name}' has been successfully {$status}. We kindly request that you collect it at your convenience. Thank you for choosing our services! 😊";
                }
            
                // Send the message
                SendServiceStatusJob::dispatch($phoneNumber, $message);
            }
            
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
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status_id' => 'required|exists:service_statuses,id',
            ]);
            $service = ProductServiceDetail::findOrFail($id);
            $service->service_status = $request->status_id;
            $service->save();
            if ($request->status_id == 1 || $request->status_id == 3) {
                $phoneNumber = '91' . $service->customer->phone_number;
                $status = ServiceStatus::find($request->status_id)->status;
        
                if ($request->status_id == 1) {
                    $message = "Your product '{$service->product_name}' has been $status. The Service ID is {$service->service_id}. Please contact us for further queries. Thank you for choosing our service! 😊";
                } elseif ($request->status_id == 3) {
                    $message = "The service for your '{$service->product_name}' has been successfully $status. We kindly collect it at your convenience. Thank you for choosing our services! 😊";
                }
                SendServiceStatusJob::dispatch($phoneNumber, $message);
            }
            return response()->json([
                'message' => 'Service status updated successfully.',
                'data' => $service,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating service status.',
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
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'product_type' => 'required|string|max:255',
                'product_name' => 'required|string|max:255',
                'model_number' => 'nullable|string|max:255',
                'serial_number' => 'nullable|string|max:255',
                'description' => 'required|string',
                'product_received_date' => 'required|date',
                'other_collected_item' => 'nullable|string',
                'service_status' => 'required|integer',
            ]);

            $product = ProductServiceDetail::findOrFail($id);
            $product->update($validated);
            // if ($product->service_status != $validated['service_status']) {
            //     if ($validated['service_status'] == 1 || $validated['service_status'] == 3) {
            //         $phoneNumber = '91' . $product->customer->phone_number;
            //         $status = ServiceStatus::find($validated['service_status'])->status;


            //         if ($validated['service_status'] == 1) {
            //             $message = "Your product '{$product->product_name}' has been $status. The Service ID is {$product->service_id}. Please contact us for further queries. Thank you for choosing our service! 😊";
            //         } elseif ($validated['service_status'] == 3) {
            //             $message = "The service for your '{$product->product_name}' has been successfully {$status}. We kindly request that you collect it at your convenience. Thank you for choosing our services! 😊";
            //         }

            //         SendServiceStatusJob::dispatch($phoneNumber, $message);
            //     }
            // }

            return response()->json([
                'message' => 'Product updated successfully',
                'product' => $product,
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
