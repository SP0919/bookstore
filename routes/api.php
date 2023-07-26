<?php

use App\Http\Controllers\Api\Customer\AbondonedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\CheckoutController;


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

Route::get('/', function () {
    return view('apisection');
});
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::middleware('CheckTokenExpiry')->group(function () {
    Route::get('logout', [RegisterController::class, 'destroy']);




    // Books
    Route::get('books', [BookController::class, 'Books']);
    Route::post('books', [BookController::class, 'store']);
    Route::get('book/{id}', [BookController::class, 'getBook']);
    Route::post('book/{id}', [BookController::class, 'updateBook']);
    Route::get('book/delete/{id}', [BookController::class, 'deleteBook']);


    // Checkout
    // Route::get('checkouts', [CheckoutController::class, 'Books']);
    Route::post('checkouts', [CheckoutController::class, 'store']);
    Route::get('checkout/{id}', [CheckoutController::class, 'getCheckout']);
    Route::post('checkout/{id}', [CheckoutController::class, 'updateCheckout']);
    // Route::get('book/delete/{id}', [CheckoutController::class, 'deleteBook']);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
