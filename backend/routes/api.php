<?php

use App\Http\Controllers\CustomerDetailController;
use App\Http\Controllers\PaymentDetailController;
use App\Http\Controllers\PaymentStatusController;
use App\Http\Controllers\ProductServiceDetailController;
use App\Http\Controllers\ServiceStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::put('/service-status/{id}', [ProductServiceDetailController::class, 'updateStatus']);
Route::put('/products/{id}', [ProductServiceDetailController::class, 'update']);
Route::get('/fetch-service-status', [ServiceStatusController::class, 'index']);
Route::get('/fetch-payment-status', [PaymentStatusController::class, 'index']);
Route::get('/fetch-payment-modes', [PaymentStatusController::class, 'fetchPaymentMode']);
Route::post('/payment-details', [PaymentDetailController::class, 'store']);
Route::get('/payment-details', [PaymentDetailController::class, 'getPaymentDetails']);
Route::put('/payment-details/{id}', [PaymentDetailController::class, 'updatePaymentDetails']);
Route::get('/customers', [CustomerDetailController::class, 'index']);
Route::get('/service-details', [ProductServiceDetailController::class, 'index']);

//Route to get payment details
Route::get('get-payment-details', [PaymentDetailController::class, 'fetchPaymentDetails']);

