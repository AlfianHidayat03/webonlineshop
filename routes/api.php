<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function() {
    Route::post('admin', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout',[AuthController::class, 'logout']);
});

 
Route::group([
    'middleware' => 'api'
],  function () {
    Route::resources([
      'categories' =>  CategoryController::class,
      'subcategories' => SubcategoryController::class,
      'sliders' => SliderController::class,
      'products' => ProductController::class,
      'members' => MemberController::class,
      'testimonis' => TestimoniController::class,
      'reviews' => ReviewController::class,
      'orders' => OrderController::class,
   ]);

});