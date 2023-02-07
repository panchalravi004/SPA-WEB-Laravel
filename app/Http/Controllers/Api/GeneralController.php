<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    function getStateByCountry($country_id)
    {
        $state = DB::table('STATE_MASTER')->where('COUNTRY_ID','=',$country_id)->get();

        return $state;
    }
    
    function getCityByState($state_id)
    {
        $city = DB::table('CITY_MASTER')->where('STATE_ID','=',$state_id)->get();

        return $city;
    }

    function getCollegeByUniversity($univ_id)
    {
        $college = DB::table('COLLEGE_MASTER')->where('UNIV_ID','=',$univ_id)->get();

        return $college;
    }
    
    function getDepartmentByCollege($college_id)
    {
        $department = DB::table('COLLEGE_DEPT_MASTER')
        ->leftJoin('DEPT_MASTER','COLLEGE_DEPT_MASTER.DEPT_ID','=','DEPT_MASTER.DEPT_ID')
        ->where('COLLEGE_ID','=',$college_id)
        ->select('DEPT_MASTER.DEPT_ID','DEPT_MASTER.DEPT_NAME')
        ->get();

        return $department;
    }
}
