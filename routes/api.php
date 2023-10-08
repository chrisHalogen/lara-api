<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\CustomerController;

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

// Versioning the API - api/v1
Route::group(
    [
        'prefix' => 'v1', // The prefix of the api path
        "namespace" => "App\Http\Controllers\Api\V1", // The namespace to import controllers
        "middleware" => "auth:sanctum"
    ],
    function () {
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('invoices', InvoiceController::class);

        Route::post('invoices/bulk', ['uses' => 'InvoiceController@bulkStore']);
    }
);
