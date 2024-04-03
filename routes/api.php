<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\ProductApiController;

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
Route::get('city', [App\Http\Controllers\Api\CityApiController::class, 'city']);
Route::get('category', [App\Http\Controllers\Api\BakeryCategoryApiController::class, 'category']);
Route::get('main-category', [App\Http\Controllers\Api\MainCategoryController::class, 'mainCategory']);


Route::post('login', [App\Http\Controllers\Api\Auth\LoginApiController::class, 'login']);
Route::post('register', [App\Http\Controllers\Api\Auth\LoginApiController::class, 'register']);

Route::post('send-otp', [App\Http\Controllers\Api\Auth\LoginApiController::class, 'sendOtp']);
Route::post('verify-otp', [App\Http\Controllers\Api\Auth\LoginApiController::class, 'verifyOtp']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::get('home', [HomeApiController::class, 'home']);
    Route::post('kyc-store', [App\Http\Controllers\Api\KycApiController::class, 'kycStore']);

    // Profile
    Route::get('profile', [App\Http\Controllers\Api\ProfileApiController::class, 'profile']);
    Route::post('update-profile-photo', [App\Http\Controllers\Api\ProfileApiController::class, 'updateProfilePhoto']);
    Route::post('update-profile', [App\Http\Controllers\Api\ProfileApiController::class, 'updateProfile']);

    // Products Api
    Route::get('all-products', [ProductApiController::class, 'allProducts']);
    Route::get('product-description/{id}', [ProductApiController::class, 'productDescription']);
    Route::get('products-by-category/{category_id}', [ProductApiController::class, 'productsByCategory']);

    // Coupon Api
    Route::get('coupon-list', [App\Http\Controllers\Api\CouponApiController::class, 'couponList']);
    Route::get('apply-coupon', [App\Http\Controllers\Api\CouponApiController::class, 'applyCoupon']);

    // Cart api
    Route::get('cart-list', [App\Http\Controllers\Api\CartApiController::class, 'cartList']);
    Route::post('add-to-cart', [App\Http\Controllers\Api\CartApiController::class, 'addToCart']);
    Route::post('update-quantity', [App\Http\Controllers\Api\CartApiController::class, 'updatedQuantity']);
    Route::post('remove-cart-product', [App\Http\Controllers\Api\CartApiController::class, 'removeCartProduct']);
    
    // Order Api
    Route::post('order-store', [App\Http\Controllers\Api\OrderApiController::class, 'orderStore']);
    Route::get('order-list', [App\Http\Controllers\Api\OrderApiController::class, 'orderList']);
    Route::get('order-detail/{order_id}', [App\Http\Controllers\Api\OrderApiController::class, 'orderDetail']);

    // Bank Details Api
    Route::post('bank-detail-store', [App\Http\Controllers\Api\BankDetailApiController::class, 'bankDetailStore']);
    Route::post('bank-detail-update', [App\Http\Controllers\Api\BankDetailApiController::class, 'bankDetailUpdate']);

    // Address Api
    Route::apiResource('address', App\Http\Controllers\Api\AddressApiController::class);
    
    // Wallete Api
    Route::get('wallet', [App\Http\Controllers\Api\WalletApiController::class, 'wallet']);
    Route::post('wallet-recharge', [App\Http\Controllers\Api\WalletApiController::class, 'walletRecharge']);

    
    // Phone pe paymentgatway 
    Route::post('initiate-payment', [App\Http\Controllers\Api\PaymentApiController::class, 'initiatePayment']);
    
    
});

// Wallet redirect url
Route::post('/phonepe/walletRedirectUrl', [App\Http\Controllers\Api\WalletApiController::class, 'redirectUrl']);
Route::post('/phonepe/walletRcallbackUrl', [App\Http\Controllers\Api\WalletApiController::class, 'callbackUrl']);

// Order redirect url
Route::post('/phonepe/redirectUrl', [App\Http\Controllers\Api\PaymentApiController::class, 'redirectUrl']);
Route::post('/phonepe/callbackUrl', [App\Http\Controllers\Api\PaymentApiController::class, 'callbackUrl']);