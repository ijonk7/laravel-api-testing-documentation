<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\User\UserController;
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

Route::get('/test', [LoginController::class, 'login']);

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('api.customer');
    Route::get('/customer/{customer}', [CustomerController::class, 'findById'])->name('api.customer.id');
    Route::post('/create-customer', [CustomerController::class, 'store'])->name('api.customer.store');
    Route::put('/edit-customer', [CustomerController::class, 'update'])->name('api.customer.update');

    Route::post('/logout', [LogoutController::class, 'logout']);
    Route::get('/get-all-user', [UserController::class, 'getAllUser']);
    Route::get('/get-current-user', [UserController::class, 'getCurrentUser']);

    Route::delete('/delete-customer/{customer}', [CustomerController::class, 'destroy'])->name('api.customer.delete');
});
