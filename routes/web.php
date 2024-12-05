<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


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

Route::get('/cp', function () {
    return view('auth.layouts.login');
})->middleware('guest')->name("login");


Route::post('/cp',[LoginController::class,'login'])->middleware('guest')->name("loginAction");
Route::get('/logout',[LoginController::class,'logout'])->middleware('auth')->name("logout");



 