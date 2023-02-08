<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UniversityController;
use App\Http\Middleware\AdminLogin;
use App\Http\Middleware\AdminLogout;
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

Route::middleware([AdminLogout::class])->group(function(){

    Route::group(['prefix'=>'Admin'],function(){

        Route::get('/login',[AuthController::class,'login'])->name('login_page');    
        Route::post('/login',[AuthController::class,'doLogin'])->name('do_login');
    });

});


Route::middleware([AdminLogin::class])->group(function(){

    Route::group(['prefix'=>'/'],function(){
        Route::get('/',[DashboardController::class,'index'])->name('dashboard');
        Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    });
    
    Route::group(['prefix'=>'Student'],function(){
        Route::get('/',[StudentController::class,'index'])->name('view_student');
        Route::get('/add-page',[StudentController::class,'addPage'])->name('view_add_page_student');
        Route::get('/edit-page/{id}',[StudentController::class,'editPage'])->name('view_edit_page_student');
        Route::post('/create',[StudentController::class,'createStudent'])->name('create_student');
        Route::post('/update/{loginId}/{studentId}',[StudentController::class,'updateStudent'])->name('update_student');
        Route::get('/delete/{loginId}',[StudentController::class,'deleteStudent'])->name('delete_student');
        Route::get('/update-status/{loginId}/{status}',[StudentController::class,'updateStatusStudent'])->name('update_status_student');
    });
    
    Route::group(['prefix'=>'Faculty'],function(){
        Route::get('/',[FacultyController::class,'index'])->name('view_faculty');
        Route::get('/add-page',[FacultyController::class,'addPage'])->name('view_add_page_faculty');
        Route::get('/edit-page/{id}',[FacultyController::class,'editPage'])->name('view_edit_page_faculty');
        Route::post('/create',[FacultyController::class,'createFaculty'])->name('create_faculty');
        Route::post('/update/{loginId}/{facultyId}',[FacultyController::class,'updateFaculty'])->name('update_faculty');
        Route::get('/delete/{loginId}',[FacultyController::class,'deleteFaculty'])->name('delete_faculty');
        Route::get('/update-status/{loginId}/{status}',[FacultyController::class,'updateStatusFaculty'])->name('update_status_faculty');
    });
    
    Route::group(['prefix'=>'Company'],function(){
        Route::get('/',[CompanyController::class,'index'])->name('view_company');
        Route::get('/add-page',[CompanyController::class,'addPage'])->name('view_add_page_company');
        Route::get('/edit-page/{id}',[CompanyController::class,'editPage'])->name('view_edit_page_company');
        Route::post('/create',[CompanyController::class,'createCompany'])->name('create_company');
        Route::post('/update/{id}',[CompanyController::class,'updateCompany'])->name('update_company');
        Route::get('/delete/{id}',[CompanyController::class,'deleteCompany'])->name('delete_company');
    });
    
    Route::group(['prefix'=>'Jobs'],function(){
        Route::get('/',[JobsController::class,'index'])->name('view_jobs');
        Route::get('/add-page',[JobsController::class,'addPage'])->name('view_add_page_jobs');
        Route::get('/edit-page/{id}',[JobsController::class,'editPage'])->name('view_edit_page_jobs');
        Route::post('/create',[JobsController::class,'createJob'])->name('create_job');
        Route::post('/update/{id}',[JobsController::class,'updateJob'])->name('update_job');
        Route::get('/delete/{id}',[JobsController::class,'deleteJob'])->name('delete_job');
        Route::get('/update-status/{id}/{status}',[JobsController::class,'updateStatusJob'])->name('update_status_ob');
    });
    
    Route::group(['prefix'=>'University'],function(){
        Route::get('/',[UniversityController::class,'index'])->name('view_university');
        Route::get('/edit-page/{id}',[UniversityController::class,'editPage'])->name('view_edit_page_university');
        Route::post('/create',[UniversityController::class,'createUniversity'])->name('create_university');
        Route::post('/update/{id}',[UniversityController::class,'updateUniversity'])->name('update_university');
        Route::get('/delete/{id}',[UniversityController::class,'deleteUniversity'])->name('delete_university');
    });
    
    Route::group(['prefix'=>'College'],function(){
        Route::get('/',[CollegeController::class,'index'])->name('view_college');
        Route::get('/edit-page/{id}',[CollegeController::class,'editPage'])->name('view_edit_page_college');
        Route::post('/create',[CollegeController::class,'createCollege'])->name('create_college');
        Route::post('/update/{id}',[CollegeController::class,'updateCollege'])->name('update_college');
        Route::get('/delete/{id}',[CollegeController::class,'deleteCollege'])->name('delete_college');
    });
    
    Route::group(['prefix'=>'Department'],function(){
        Route::get('/',[DepartmentController::class,'index'])->name('view_department');
        Route::get('/edit-page/{id}',[DepartmentController::class,'editPage'])->name('view_edit_page_dept_in_college');
        Route::post('/create',[DepartmentController::class,'createDepartment'])->name('create_department');
        Route::get('/delete/{id}',[DepartmentController::class,'deleteDepartment'])->name('delete_department');
        Route::get('/update',[DepartmentController::class,'updateDepartment'])->name('update_department');
        Route::post('/add-dept-in-college',[DepartmentController::class,'addDepartmentInCollege'])->name('add_department_in_college');
        Route::post('/update-dept-in-college/{id}',[DepartmentController::class,'updateDepartmentInCollege'])->name('update_department_in_college');
        Route::get('/remove-dept-from-college/{id}',[DepartmentController::class,'removeDepartmentFromCollege'])->name('remove_department_from_college');
    });
});




