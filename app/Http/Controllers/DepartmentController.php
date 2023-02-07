<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        try{

            $department = DB::table('DEPT_MASTER')->get();

            $departmentInCollege = DB::table('COLLEGE_DEPT_MASTER')
            ->leftJoin('COLLEGE_MASTER','COLLEGE_DEPT_MASTER.COLLEGE_ID','=','COLLEGE_MASTER.COLLEGE_ID')
            ->leftJoin('DEPT_MASTER','COLLEGE_DEPT_MASTER.DEPT_ID','=','DEPT_MASTER.DEPT_ID')
            ->select('COLLEGE_MASTER.COLLEGE_NAME','DEPT_MASTER.DEPT_NAME')
            ->get();

            $data = compact('department','departmentInCollege');

            return view('section/university/manage_department')->with($data);

        }catch(Exception $e){

            return view('error/404');
        }
    }
}
