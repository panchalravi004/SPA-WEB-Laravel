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

            $jobPost = $this->monthlyJobPost();
            $studentRatio = $this->getStudentRatio();
            
            $data = compact('student_count','faculty_count','company_count','jobs_count','jobPost','studentRatio');
    
            return view('section/dashboard')->with($data);
            
        } catch (Exception $e) {
            return view('error/404');
        }

    }

    public function monthlyJobPost()
    {
        $jobPost = DB::table('JOB_MASTER')
        ->select(DB::raw('count(*) as count'))
        ->whereYear('REG_START_DATE',date('Y'))
        ->groupBy(DB::raw("Month(REG_START_DATE)"))
        ->pluck('count');

        $month = DB::table('JOB_MASTER')
        ->select(DB::raw("Month(REG_START_DATE) as month"))
        ->whereYear('REG_START_DATE',date('Y'))
        ->groupBy(DB::raw("Month(REG_START_DATE)"))
        ->pluck('month');

        $chartdata = array();
        for ($i=0; $i < 12; $i++) { 
            $chartdata[$i] = 0;
        }

        foreach ($month as $key => $value) {
            $chartdata[$value-1] = $jobPost[$key];
        }

        return $chartdata;
    }

    public function getStudentRatio()
    {
        $totalStudent = DB::table('STUDENT_MASTER')->count();
        $placedStudent = DB::table('JOB_APPLICATION_MASTER')
        ->distinct()
        ->where('IS_PLACED','=','1')
        ->count();

        $data = array($placedStudent,$totalStudent-$placedStudent);

        return $data;
    }
}
