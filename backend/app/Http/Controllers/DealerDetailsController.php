<?php

namespace App\Http\Controllers;

use App\Exports\DealersDetailExport;
use App\Models\DealerDetails;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DealerDetailsController extends Controller
{
    public function store(Request $request)
    {
        // return response()->json($request->all());
        $validated = $request->validate([
            'service_id' => 'required|exists:product_service_details,id',
            'dealer_id' => 'required|exists:dealers,id',
            'product_description' => 'required|string',
            'status_id' => 'required|exists:dealers_status,id',
            'payment_status_id' => 'required|exists:payment_statuses,id',
            'amount' => [
                'required_if:payment_status_id,2',
                'nullable',
                'numeric',
                'min:0'
            ],
            'amount_received_date' => [
                'required_if:payment_status_id,2',
                'nullable',
                'date',
            ],
            'payment_mode' => [
                'required_if:payment_status_id,2',
                'nullable',
                'numeric',
                'min:0'
            ],
        ],
        [
            'amount.required_if' => 'The Amount field is required when payment status is paid.',
            'payment_mode.required_if' => 'The Payment mode field is required when payment status is paid.',
            'amount_received_date.required_if' => 'The Payment date field is required when payment status is paid.',
        ]
    );
        

        $dealerDetail = DealerDetails::create($validated);

        return response()->json([
            'message' => 'Dealer details saved successfully.',
            'data' => $dealerDetail,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Find the existing dealer record
        $dealerDetail = DealerDetails::find($id);

        if (!$dealerDetail) {
            return response()->json([
                'message' => 'Dealer details not found.',
            ], 404);
        }

        // Validate the input data
        $validated = $request->validate([
            'service_id' => 'required|exists:product_service_details,id',
            'dealer_id' => 'required|exists:dealers,id',
            'product_description' => 'required|string',
            'status_id' => 'required|exists:dealers_status,id',
            'payment_status_id' => 'required|exists:payment_statuses,id',
            'amount' => [
                'required_if:payment_status_id,2',
                'nullable',
                'numeric',
                'min:0'
            ],
            'amount_received_date' => [
                'required_if:payment_status_id,2',
                'nullable',
                'date',
            ],
            'payment_mode' => [
                'required_if:payment_status_id,2',
                'nullable',
                'numeric',
                'min:0'
            ],
        ],
        [
            'amount.required_if' => 'The Amount field is required when payment status is paid.',
            'amount_received_date.required_if' => 'The Payment date field is required when payment status is paid.',
            'payment_mode.required_if' => 'The Payment mode field is required when payment status is paid.',
        ]
    );

        $dealerDetail->update($validated);

        return response()->json([
            'message' => 'Dealer details updated successfully.',
            'data' => $dealerDetail,
        ]);
    }


    public function getDealersData(Request $request)
    {
        try {
            $dealerDetail = DealerDetails::where('dealer_id', $request->dealer_id)
                ->where('service_id', $request->service_id)
                ->first();

            return response()->json([
                'exists' => $dealerDetail ? true : false,
                'data' => $dealerDetail,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'exists' => false,
                'message' => 'An error occurred while fetching Dealers details.',
                'error' => $e->getMessage(),
            ], 200); 
        }
    }
    public function fetchDealersDetails()
    {
        $dealersDetails = DealerDetails::join('product_service_details', 'product_service_details.id', '=', 'dealer_details.service_id')
        ->join('payment_statuses', 'payment_statuses.id', 'dealer_details.payment_status_id')
        ->join('dealers', 'dealers.id', 'dealer_details.dealer_id')
        ->join('customer_details', 'customer_details.id', 'product_service_details.customer_id')
        ->leftJoin('payment_modes', 'dealer_details.payment_mode', '=', 'payment_modes.id')
        ->select(
            'dealer_details.*', 
            'dealers.name as dealer_name',
            'dealers.phone_number as dealer_phone_no',
            'payment_modes.mode as payment_mode',
            'payment_statuses.payment_status',
            'customer_details.name as customer_name', 
            'product_service_details.service_id', 
            'product_service_details.product_type', 
            'product_service_details.product_name'
        )
        ->orderBy('dealer_details.id', 'desc')
        ->get();
       
        if ($dealersDetails->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No Dealers details found.',
            ], 404);
        }

        return response()->json($dealersDetails);
    }
    public function dealersDetailExcelExport(Request $request)
    {
        $excelData = $request->input('reportData');
        if (!is_array($excelData)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }
        return Excel::download(new DealersDetailExport($excelData), 'DealersDetailsReport.xlsx');
    }

}
