<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\ProductAPIController;
use App\Http\Controllers\API\SellerAPIController;
use App\Http\Controllers\ProductController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});
Route::get('login', function () {
    return "<h1>Login please!</h1>";
});
Route::get('register', function () {
    return "<h1>Register please!</h1>";
});
Route::get('/', function () {
    return "<h1>Hi</h1>";
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/resource-product', ProductAPIController::class);
    Route::resource('/resource-seller', SellerAPIController::class);
    Route::get('/resource-product/search/{name}', [ProductAPIController::class, 'search'])->name('product.search');
});
