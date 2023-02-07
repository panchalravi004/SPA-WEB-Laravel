<?php

use App\Http\Controllers\Api\GeneralController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-state-by-country/{id}', [GeneralController::class, 'getStateByCountry']);

Route::get('/get-city-by-state/{id}', [GeneralController::class, 'getCityByState']);

Route::get('/get-college-by-university/{id}', [GeneralController::class, 'getCollegeByUniversity']);

Route::get('/get-department-by-college/{id}', [GeneralController::class, 'getDepartmentByCollege']);
