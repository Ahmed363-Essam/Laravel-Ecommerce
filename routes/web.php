<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PaymentsCotroller;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Auth\SociallizeController;
use App\Http\Controllers\Front\CategoriesController;
use App\Http\Controllers\Front\DeliveryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dash', function () {
    return view('dashboard');
})->middleware(['auth']);



Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('show/{id}', [ProductController::class, 'show'])->name('product.show');


Route::get('getProduct',[ProductController::class,'index'])->name('product.index');

Route::get('cats',[CategoriesController::class,'index'])->name('product.cats');

Route::get('productCat/{id}',[CategoriesController::class,'ProductCategories'])->name('Product.CatProduct');

Route::group([
    'namespace' => 'Front'
], function () {
    Route::resource('cart', CartsController::class);

    Route::get('/checkOut', [CheckoutController::class, 'create'])->name('checkOut');

    Route::post('/checkOut', [CheckoutController::class, 'store'])->name('CheckOutPost');



});


Route::get('/auth/{provider}/redirect', [SociallizeController::class, 'redirect'])->name('auth.socilaite.redirect');

Route::get('/auth/{provider}/callback', [SociallizeController::class, 'callback'])->name('auth.socilaite.callback');


Route::get('orders/{order}/pay', [PaymentsCotroller::class, 'create'])
    ->name('orders.payments.create');


Route::post('orders/{order}/stripe/paymeny-intent', [PaymentsCotroller::class, 'CreateStripePaymentIntent'])
    ->name('stripe.paymentIntent.create');


Route::get('orders/{order}/pay/stripe/callback', [PaymentsCotroller::class, 'confirm'])
    ->name('stripe.return');


// AUTH/GOOGLE/DSDSDS

// maps

Route::get('/orders/{order}', [DeliveryController::class, 'show'])->name('orders.show');





// require __DIR__.'/auth.php';

require __DIR__ . '/dashboard.php';
