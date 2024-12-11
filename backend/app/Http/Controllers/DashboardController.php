<?php

namespace App\Http\Controllers;

use App\Models\CustomerDetail;
use App\Models\PaymentDetail;
use App\Models\ProductServiceDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

    public function getCustomerCount(){
        $customerCount = CustomerDetail::count();
        return response()->json(['customerCount' => $customerCount]);
    }

    public function getYearlyIncome()
    {
        // Get the current year
        $currentYear = now()->year;
        $startOfYear = now()->startOfYear(); // Start of the current year
        $endOfYear = now()->endOfYear();     // End of the current year

        // Query to get the total payment amount for each month of the current year
        $yearlyIncome = PaymentDetail::selectRaw('DATE_FORMAT(payment_date, "%Y-%m") as month, SUM(paid_amount) as total_income')
            ->whereBetween('payment_date', [$startOfYear, $endOfYear])
            ->where('payment_status', '=', 2)
            ->groupByRaw('DATE_FORMAT(payment_date, "%Y-%m")')
            ->orderByRaw('DATE_FORMAT(payment_date, "%Y-%m")')
            ->get();

        // Fill missing months with 0 income
        $allMonths = collect(range(1, 12))->map(function ($month) use ($currentYear, $yearlyIncome) {
            $date = now()->setYear($currentYear)->month($month); // Set date to the current year and specific month
            $monthName = $date->format('F'); // Get the full month name
            $income = $yearlyIncome->firstWhere('month', $date->format('Y-m')); // Find the matching data or set default
            return [
                'month' => $monthName,
                'total_income' => $income ? $income->total_income : 0,
            ];
        });

        return response()->json($allMonths);
    }

    public function getServiceDetails(){
        $serviceDetails = ProductServiceDetail::selectRaw('service_status, COUNT(*) as count')
                            ->whereIn('service_status', [1, 2, 3])
                            ->groupBy('service_status')
                            ->get();

        return $serviceDetails;
    }

    public function getMonthlyServiceDetails()
    {
        $currentYear = now()->year; // Get the current year
        $startOfYear = now()->startOfYear(); // Start of the current year
        $endOfYear = now()->endOfYear(); // End of the current year

        // Query to get the counts grouped by month for the current year
        $yearlyData = ProductServiceDetail::selectRaw("
                DATE_FORMAT(product_received_date, '%Y-%m') as month,
                COUNT(*) as count
            ")
            ->whereBetween('product_received_date', [$startOfYear, $endOfYear])
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Generate data for all months in the current year
        $monthlyServiceDetails = collect(range(1, 12))->map(function ($month) use ($currentYear, $yearlyData) {
            $monthYear = now()->setYear($currentYear)->month($month)->format('Y-m'); // Format Year-Month
            $monthName = now()->month($month)->format('F'); // Get full month name

            // Find the matching count or default to 0
            $countData = $yearlyData->firstWhere('month', $monthYear);

            return [
                'month' => $monthName,
                'count' => $countData ? $countData->count : 0,
            ];
        });

        return $monthlyServiceDetails;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
