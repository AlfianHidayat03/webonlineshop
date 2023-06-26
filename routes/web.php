<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//auth
Route::get('login',[AuthController::class, 'index'])->name('login');
Route::get('/logout',[AuthController::class, 'logout']); 


//data master
Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
Route::resource('/subcategories', \App\Http\Controllers\SubcategoryController::class);
Route::resource('/sliders', \App\Http\Controllers\SliderController::class);
Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('/testimonis', \App\Http\Controllers\TestimoniController::class);

//dashboard
Route::get('/dashboard',[DashboardController::class, 'index']);