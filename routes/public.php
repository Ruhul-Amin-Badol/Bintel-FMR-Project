<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\FrontLibraryController;

use App\Http\Controllers\FrontLoginController;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| All Public Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LeaderboardController::class, 'home'])->name('home');
Route::post('/rank', [LeaderboardController::class, 'rank'])->name('rank');
Route::get('/rank', [LeaderboardController::class, 'home'])->name('rank2');

// library visiting report
Route::get('/library-visit-form', [FrontLibraryController::class, 'LibraryReport'])->name("library.visit.front");
Route::post('/library-visit-form/new',[FrontLibraryController::class, 'Library_visit_new_front_Action'])->name("library.visit.new.front.action");
Route::get('/success-report', [FrontLibraryController::class, 'SuccessPage'])->name("success.report");

Route::get('/get-division', [FrontLibraryController::class, 'getDivision'])->name('get.division');
Route::get('/get-districts', [FrontLibraryController::class, 'getDistricts'])->name('get.districts');
Route::get('/get-upazilas', [FrontLibraryController::class, 'getUpazilas'])->name('get.upazilas');

Route::get('/officer-login', [FrontLoginController::class, 'OfficerLogin'])->name('officer.login');
Route::post('/officer_login_submit', [FrontLoginController::class, 'loginSubmit'])->name('officer.login.submit');

// Route::get('/officer-logout', function () {
//      Session::flush();
//      return redirect()->route('officer.login');
// })->name("officer.logout");
Route::get('/officer-logout', function () {
    Session::forget('officer');
    return redirect()->route('officer.login');
})->name("officer.logout");

