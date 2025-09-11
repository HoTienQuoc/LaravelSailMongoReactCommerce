<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


//products routes
Route::get('products',[ProductController::class,'index']);
Route::get('products/{color}/color',[ProductController::class,'filterProductsByColor']);
Route::get('products/{size}/size',[ProductController::class,'filterProductsBySize']);
Route::get('products/{searchTerm}/find',[ProductController::class,'findProductsByTerm']);
Route::get('product/{product}/show',[ProductController::class,'show']);
