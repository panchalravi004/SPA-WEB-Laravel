<?php

use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UniversityController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'/'],function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
});

Route::group(['prefix'=>'Student'],function(){
    Route::get('/',[StudentController::class,'index'])->name('view_student');
    Route::get('/add-page',[StudentController::class,'addPage'])->name('view_add_page_student');
});

Route::group(['prefix'=>'Faculty'],function(){
    Route::get('/',[FacultyController::class,'index'])->name('view_faculty');
    Route::get('/add-page',[FacultyController::class,'addPage'])->name('view_add_page_faculty');
});

Route::group(['prefix'=>'Company'],function(){
    Route::get('/',[CompanyController::class,'index'])->name('view_company');
    Route::get('/add-page',[CompanyController::class,'addPage'])->name('view_add_page_company');
});

Route::group(['prefix'=>'Jobs'],function(){
    Route::get('/',[JobsController::class,'index'])->name('view_jobs');
    Route::get('/add-page',[JobsController::class,'addPage'])->name('view_add_page_jobs');
});

Route::group(['prefix'=>'University'],function(){
    Route::get('/',[UniversityController::class,'index'])->name('view_university');
});

Route::group(['prefix'=>'College'],function(){
    Route::get('/',[CollegeController::class,'index'])->name('view_college');
});

Route::group(['prefix'=>'Department'],function(){
    Route::get('/',[DepartmentController::class,'index'])->name('view_department');
});

