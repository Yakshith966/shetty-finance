<?php

use App\Exports\CustomerExport;
use App\Http\Controllers\CustomerDetailController;
use App\Http\Controllers\ProductServiceDetailController;
use App\Http\Controllers\ServiceStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerExportController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route to store customer details
Route::post('/store-customer-details', [CustomerDetailController::class, 'store']);

//Route to store product service details
Route::post('/store-product-service-details', [ProductServiceDetailController::class, 'store']);
Route::get('/fetch-service-status', [ServiceStatusController::class, 'index']);

// Route::get('/get-customer-details', [CustomerDetailController::class, 'store']);

Route::get('/customers', [CustomerDetailController::class, 'index']);
Route::put('/customers/{id}', [CustomerDetailController::class, 'update']);

Route::post('/download-customer-details', [CustomerExportController::class, 'exportCustomerDetails']);


Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// Route::middleware('throttle:login')->post('/login', [AuthController::class, 'login']);
