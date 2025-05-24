<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanPaymentController;
use App\Http\Controllers\MemberController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/branches', [BranchController::class, 'index']);
    Route::post('/members', [MemberController::class, 'store']);
    Route::get('/members', [MemberController::class, 'index']);
    Route::post('/loans', [LoanController::class, 'store']);
    Route::get('/loans-with-payments', [LoanController::class, 'index']);
    Route::post('/add-payments', [LoanPaymentController::class, 'store']);
    Route::post('/loans/{loan}/renew', [LoanController::class, 'renew']);
    Route::get('/loans/{loan}/details', [LoanController::class, 'details']);
    Route::put('/loan-payments/{id}', [LoanPaymentController::class, 'update']);
    Route::get('/loans/{id}', [LoanController::class, 'show']);
    Route::post('/loans/{loan}/close', [LoanController::class, 'closeLoan']);
});
