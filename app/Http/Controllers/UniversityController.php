<?php

namespace App\Http\Controllers;

use App\Models\University;
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
            ->select('UNIV_MASTER.UNIV_ID','UNIV_MASTER.UNIV_NAME','CITY_MASTER.CITY_NAME','STATE_MASTER.STATE_NAME','COUNTRY_MASTER.COUNTRY_NAME')
            ->get();

            $country = DB::table('COUNTRY_MASTER')->get();

            $data = compact('university','country');

            return view('section/university/manage_university')->with($data);

        } catch (Exception $e) {
            
            return view('error/404');
        }

    }

    public function editPage($id){

        try {
            
            $country = DB::table('COUNTRY_MASTER')->get();

            $university = DB::table('UNIV_MASTER')
            ->leftJoin('CITY_MASTER','UNIV_MASTER.CITY_ID','=','CITY_MASTER.CITY_ID')
            ->leftJoin('STATE_MASTER','CITY_MASTER.STATE_ID','=','STATE_MASTER.STATE_ID')
            ->leftJoin('COUNTRY_MASTER','STATE_MASTER.COUNTRY_ID','=','COUNTRY_MASTER.COUNTRY_ID')
            ->where('UNIV_MASTER.UNIV_ID','=',$id)
            ->get()[0];

            $state = DB::table('STATE_MASTER')->where('STATE_MASTER.COUNTRY_ID','=',$university->COUNTRY_ID)->get();
            $city = DB::table('CITY_MASTER')->where('CITY_MASTER.STATE_ID','=',$university->STATE_ID)->get();


            $data = compact('country','state','city','university');

            return view('section/university/update_university')->with($data);

        } catch (Exception $e) {
            
            return view('error/404');
        }
    }

    public function createUniversity(Request $request)
    {
        $university = new University();
        $university->UNIV_NAME = $request['univerity_name'];
        $university->ADD1 = $request['university_street'];
        $university->CITY_ID = $request['university_city'];

        if($university->save()){
            return redirect()->back()->withError("University Created Successfully !");
        }

        return back();
    }

    public function updateUniversity(Request $request,$id)
    {
        $university = University::find($id);
        $university->UNIV_NAME = $request['univerity_name'];
        $university->ADD1 = $request['university_street'];
        $university->CITY_ID = $request['university_city'];

        if($university->save()){
            return redirect()->back()->withError("University Updated Successfully !");
        }

        return back();
    }

    public function deleteUniversity($id)
    {
        $university = University::find($id)->delete();

        if($university){
            return redirect()->back()->withError("University Deleted Successfully !");
        }

        return back();
    }

}
