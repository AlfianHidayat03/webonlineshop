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
Route::post('/login',[AuthController::class, 'login']); 
Route::get('/logout',[AuthController::class, 'logout']); 


//kategori
Route::get('/kategori',[CategoryController::class, 'list']);

//dashboard
Route::get('/dashboard',[DashboardController::class, 'index']);