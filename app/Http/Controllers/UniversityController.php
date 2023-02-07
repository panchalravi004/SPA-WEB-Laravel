<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniversityController extends Controller
{
    public function index(){

        try {
            
            $university = DB::table('UNIV_MASTER')
            ->leftJoin('CITY_MASTER','UNIV_MASTER.CITY_ID','=','CITY_MASTER.CITY_ID')
            ->leftJoin('STATE_MASTER','CITY_MASTER.STATE_ID','=','STATE_MASTER.STATE_ID')
            ->leftJoin('COUNTRY_MASTER','STATE_MASTER.COUNTRY_ID','=','COUNTRY_MASTER.COUNTRY_ID')
            ->select('UNIV_MASTER.UNIV_NAME','CITY_MASTER.CITY_NAME','STATE_MASTER.STATE_NAME','COUNTRY_MASTER.COUNTRY_NAME')
            ->get();

            $data = compact('university');

            return view('section/university/manage_university')->with($data);

        } catch (Exception $e) {
            
            return view('error/404');
        }

    }
}
