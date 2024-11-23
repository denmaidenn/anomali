<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthControllerAPI;
use App\Http\Controllers\API\PelatihanControllerAPI;
use App\Http\Controllers\API\FishpediaControllerAPI;
use App\Http\Controllers\API\FishmartControllerAPI;
use App\Http\Controllers\API\MobileAuthControllerAPI;
use App\Http\Controllers\API\FeedbackControllerAPI;
use App\Http\Controllers\API\PelatihanfreeControllerAPI;
use App\Http\Controllers\API\PelatihControllerAPI;

use App\Http\Controllers\API\CartControllerAPI;
use App\Http\Controllers\API\CartItemControllerAPI;
use App\Http\Controllers\API\CheckoutControllerAPI;
// Route untuk menampilkan semua data ikan


// Untuk Admin Login
Route::post('/login', [AuthControllerAPI::class, 'in']);

Route::prefix('admin')->group(function () {
    Route::get('/', [AuthControllerAPI::class, 'index']);
    Route::post('/create', [AuthControllerAPI::class,'store']);
    Route::get('/{id}', [AuthControllerAPI::class, 'show']);
    Route::put('/{id}', [AuthControllerAPI::class,'update']);
    Route::delete('/{id}', [AuthControllerAPI::class,'delete']);
});

// Untuk Mobile User Register dan Login
Route::prefix('formuser')->group(function () {
    Route::get('/', [MobileAuthControllerAPI::class, 'index']);
    Route::post('/create', [MobileAuthControllerAPI::class,'store']);
    Route::post('/login', [MobileAuthControllerAPI::class,'login']);

});

Route::prefix('feedback')->group(function () {
    Route::get('/', [FeedbackControllerAPI::class, 'index']); // For viewing feedback (e.g., for admin)
    Route::post('/create', [FeedbackControllerAPI::class, 'store']);
    Route::get('/{id}', [FeedbackControllerAPI::class, 'show']);
    Route::put('/{id}', [FeedbackControllerAPI::class,'update']);
    Route::delete('/{id}', [FeedbackControllerAPI::class,'delete']);
});

Route::prefix('formuser')->group(function () {
    Route::put('/{id}/picture', [MobileAuthControllerAPI::class,'updatePicture']);
    Route::get('/{id}', [MobileAuthControllerAPI::class, 'show']);
    Route::put('/{id}', [MobileAuthControllerAPI::class,'update']);
    Route::delete('/{id}', [MobileAuthControllerAPI::class,'delete']);
    Route::put('/{id}/paymentinfo', [MobileAuthControllerAPI::class,'updatePaymentInfo']);
});



Route::prefix('pelatihan')->group(function () {
    Route::get('/', [PelatihanControllerAPI::class, 'index']);
    Route::post('/create', [PelatihanControllerAPI::class,'store']);
    Route::get('/{id}', [PelatihanControllerAPI::class, 'show']);
    Route::put('/{id}', [PelatihanControllerAPI::class, 'update']);
    Route::delete('/{id}', [PelatihanControllerAPI::class, 'delete']);
});

Route::prefix('pelatihanfree')->group(function () {
    Route::get('/', [PelatihanfreeControllerAPI::class, 'index']);
    Route::post('/create', [PelatihanfreeControllerAPI::class,'store']);
    Route::get('/{id}', [PelatihanfreeControllerAPI::class, 'show']);
    Route::put('/{id}', [PelatihanfreeControllerAPI::class, 'update']);
    Route::delete('/{id}', [PelatihanfreeControllerAPI::class, 'delete']);
});


Route::prefix('pelatih')->group(function () {
    Route::get('/', [PelatihControllerAPI::class, 'index']);
    Route::post('/create', [PelatihControllerAPI::class,'store']);
    Route::get('/{id}', [PelatihControllerAPI::class, 'show']);
    Route::put('/{id}', [PelatihControllerAPI::class, 'update']);
    Route::delete('/{id}', [PelatihControllerAPI::class, 'delete']);
});

Route::prefix('fishpedia')->group(function () {
    Route::get('/', [FishpediaControllerAPI::class, 'index']);
    Route::post('/create', [FishpediaControllerAPI::class,'store']);
    Route::get('/{id}', [FishpediaControllerAPI::class, 'show']);
    Route::put('/{id}', [FishpediaControllerAPI::class, 'update']);
    Route::delete('/{id}', [FishpediaControllerAPI::class, 'delete']);
});

Route::prefix('fishmart')->group(function () {
    Route::get('/', [FishmartControllerAPI::class, 'index']);
    Route::post('/create', [FishmartControllerAPI::class,'store']);     
    Route::get('/{id}', [FishmartControllerAPI::class, 'show']);
    Route::put('/{id}', [FishmartControllerAPI::class, 'update']);
    Route::delete('/{id}', [FishmartControllerAPI::class, 'delete']);
});




Route::prefix('cart')->group(function () {
    Route::get('/', [CartControllerAPI::class, 'getUsersWithCarts']);
    Route::get('{userId}', [CartControllerAPI::class, 'viewUserCart']);    Route::get('/{id}', [CartControllerAPI::class, 'getCart']);
    Route::post('/add', [CartControllerAPI::class, 'addToCart']);
    Route::get('/view/{id}', [CartControllerAPI::class, 'viewCartWithItems']);
    Route::delete('/delete/{id}', [CartControllerAPI::class, 'removeFromCart']);
});

Route::prefix('cart-items')->group(function () {
    Route::post('/add', [CartItemControllerAPI::class, 'addItem']);
    Route::put('/update/{id}', [CartItemControllerAPI::class, 'updateItem']);
    Route::delete('/remove/{id}', [CartItemControllerAPI::class, 'removeItem']);
    Route::get('/{cart_id}', [CartItemControllerAPI::class, 'getItemsByCart']);
});


Route::get('/checkout-all', [CheckoutControllerAPI::class, 'getUsersWhoCheckedOut']);

Route::post('/checkout', [CheckoutControllerAPI::class, 'checkout']);
Route::post('/direct-checkout', [CheckoutControllerAPI::class, 'directCheckout']);

Route::get('/orders/{user_id}', [CheckoutControllerAPI::class, 'getUserOrders']);
Route::get('/order/{order_id}', [CheckoutControllerAPI::class, 'getOrderDetail']);
Route::put('/order/{order_id}/status', [CheckoutControllerAPI::class, 'updateOrderStatus']);













Route::middleware(['auth:sanctum', 'auth'])->group(function () {





});





