<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AccessTokenController;
use App\Http\Controllers\Api\DeliveryController;

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
//Route::delete('/delete', [ProductController::class, 'destroy']);
Route::post('forceDelete',[ ProductController::class,'forceDelete1'])->name('forceDelete');
Route::resource('products1', ProductController::class);

Route::put('/updateMap/{delivery}',[ DeliveryController::class,'update'])->name('updateMap');

Route::get('/showMap/{delivery}',[ DeliveryController::class,'show'])->name('showMap');



Route::post('auth/access-tokens', [AccessTokenController::class, 'store'])->middleware('guest:sanctum');

