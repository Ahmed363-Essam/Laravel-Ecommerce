<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashBoardController;

use App\Http\Controllers\Dashboard\ProfilesController;


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::group(
    [
        'prefix' => 'admin/dashboard',
        'namespace'=>'Dashboard',
        'middleware'=>['auth:admin']
    ],
    function () {

        // user profile
        Route::get('profile', [ProfilesController::class, 'edit'])->name('profile.edit'); //exist
        Route::put('profile', [ProfilesController::class, 'update'])->name('profile.update'); //exist


        Route::get('trashed','CategoriesController@trashed')->name('trashed'); // soft deleted
        Route::post('trashed','CategoriesController@force')->name('force');
        Route::post('restore','CategoriesController@restore')->name('restore');
        Route::resource('categories', CategoriesController::class); // All Categories



        Route::resource('products', ProductsController::class);  // All Products
        Route::get('trashedProduct','ProductsController@trashed')->name('products.trashed');
        Route::post('trashedProduc','ProductsController@force')->name('products.force');
        Route::post('restoreProduct','ProductsController@restore')->name('products.restore');


        Route::resource('tags', TagesController::class);  



        Route::get('dashboard',[DashBoardController::class,'index'])->name('dashboard');
    }



);


