<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExports;
use App\Models\CustomerDetail;
use App\Models\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class CustomerExportController extends Controller
{
    public function exportCustomerDetails()
    {
        try {
            // Fetch customer data from the database
            $customers = CustomerDetail::select('id', 'name', 'phone_number', 'email', 'alternate_phone_number')->get();

            // Return the data as an Excel file using the CustomerExport class
            return Excel::download(new CustomerExports($customers), 'customer_details.xlsx');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to export data.'], 500);
        }
    }
}
