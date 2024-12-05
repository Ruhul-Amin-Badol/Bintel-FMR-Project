<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\LibraryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes Created by--Ruhul Amin
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//auth login api route
Route::post('login', [AuthController::class, 'login']);

    //route for location find,divisions,districts,upazilas
    Route::get('/divisions', [LibraryController::class, 'getDivisions']);
    Route::get('/districts/{division_id}', [LibraryController::class, 'getDistrictsByDivision']);
    Route::get('/upazilas/{district_id}', [LibraryController::class, 'getUpazilasByDistrict']);

Route::middleware('auth:sanctum')->group(function () {

    //Library Route
    Route::get('/libraries', [LibraryController::class, 'index']);
    Route::get('/all-libraries', [LibraryController::class, 'getAllLibraries']);
    Route::post('/libraries', [LibraryController::class, 'store']);
    Route::get('/libraries/{id}', [LibraryController::class, 'show']);
    Route::get('/libraries/{id}/edit', [LibraryController::class, 'edit']);
    Route::post('/libraries/{id}', [LibraryController::class, 'update']);
    Route::delete('/libraries/{id}', [LibraryController::class, 'destroy']);

    // Batch routes
    Route::get('/batches', [BatchController::class, 'index']);
    Route::get('/all-batches', [BatchController::class, 'getAllBatches']);
    Route::post('/batches', [BatchController::class, 'store']);
    Route::get('/batches/{id}', [BatchController::class, 'show']);
    Route::get('/batches/{id}/edit', [BatchController::class, 'edit']);
    Route::post('/batches/{id}', [BatchController::class, 'update']);
    Route::delete('/batches/{id}', [BatchController::class, 'destroy']);

    // Institution routes
    Route::get('/institutions', [InstitutionController::class, 'index']); 
    Route::get('/all-institutions', [InstitutionController::class, 'getAllInstitutions']);
    Route::post('/institutions', [InstitutionController::class, 'store']); 
    Route::get('/institutions/{id}', [InstitutionController::class, 'show']);
    Route::post('/institutions/{id}', [InstitutionController::class, 'update']); 
    Route::delete('/institutions/{id}', [InstitutionController::class, 'destroy']);

    //logout route
    Route::post('logout', [AuthController::class, 'logout']);

});
