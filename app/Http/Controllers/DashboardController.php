<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        try {
            $student_count = DB::table('STUDENT_MASTER')->count();
            $faculty_count = DB::table('FACULTY_OR_TPO_MASTER')->count();
            $company_count = DB::table('COMPANY_MASTER')->count();
            $jobs_count = DB::table('JOB_MASTER')->count();
    
            // return $users;
            
            $data = compact('student_count','faculty_count','company_count','jobs_count');
    
            return view('section/dashboard')->with($data);
            
        } catch (Exception $e) {
            return view('error/404');
        }

    }
}
