<?php

use App\Http\Controllers\VehicleController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/vehicles', [VehicleController::class, 'index']);
Route::middleware('auth:api')->post('/vehicles/store', [VehicleController::class, 'store'])->name('store');
Route::middleware('auth:api')->put('/vehicles/update', [VehicleController::class, 'update'])->name('update');
Route::middleware('auth:api')->delete('/vehicles/delete', [VehicleController::class, 'destroy'])->name('delete');