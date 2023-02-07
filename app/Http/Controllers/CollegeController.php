<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollegeController extends Controller
{
    public function index(){
        try {
            
            $college = DB::table('COLLEGE_MASTER')
            ->leftJoin('UNIV_MASTER','COLLEGE_MASTER.UNIV_ID','=','UNIV_MASTER.UNIV_ID')
            ->leftJoin('CITY_MASTER','COLLEGE_MASTER.CITY_ID','=','CITY_MASTER.CITY_ID')
            ->leftJoin('STATE_MASTER','CITY_MASTER.STATE_ID','=','STATE_MASTER.STATE_ID')
            ->leftJoin('COUNTRY_MASTER','STATE_MASTER.COUNTRY_ID','=','COUNTRY_MASTER.COUNTRY_ID')
            ->select('COLLEGE_MASTER.COLLEGE_NAME','UNIV_MASTER.UNIV_NAME','CITY_MASTER.CITY_NAME','STATE_MASTER.STATE_NAME','COUNTRY_MASTER.COUNTRY_NAME')
            ->get();

            $data = compact('college');

            return view('section/university/manage_college')->with($data);

        } catch (Exception $e) {
            return view('error/404');
        }
    }
}
