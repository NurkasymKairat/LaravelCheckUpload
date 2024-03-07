<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
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



Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/register', [IndexController::class, 'register_page']);
Route::get('/login', [IndexController::class, 'login_page']);




Route::post('/register-create', [AuthController::class, 'register_store']);
Route::post('/login-create', [AuthController::class, 'login_store']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
Route::post('/check-upload', [CheckController::class, 'check_upload'])->middleware('auth');



