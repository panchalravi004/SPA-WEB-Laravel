<?php

namespace App\Http\Controllers;

use App\Models\College;
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
            ->select('COLLEGE_MASTER.COLLEGE_ID','COLLEGE_MASTER.COLLEGE_NAME','UNIV_MASTER.UNIV_NAME','CITY_MASTER.CITY_NAME','STATE_MASTER.STATE_NAME','COUNTRY_MASTER.COUNTRY_NAME')
            ->get();

            $country = DB::table('COUNTRY_MASTER')->get();
            $university = DB::table('UNIV_MASTER')->select('UNIV_ID','UNIV_NAME')->get();

            $data = compact('university','college','country');

            return view('section/university/manage_college')->with($data);

        } catch (Exception $e) {
            return view('error/404');
        }
    }

    public function editPage($id){

        try {
            
            $country = DB::table('COUNTRY_MASTER')->get();
            $university = DB::table('UNIV_MASTER')->get();

            $college = DB::table('COLLEGE_MASTER')
            ->leftJoin('CITY_MASTER','COLLEGE_MASTER.CITY_ID','=','CITY_MASTER.CITY_ID')
            ->leftJoin('STATE_MASTER','CITY_MASTER.STATE_ID','=','STATE_MASTER.STATE_ID')
            ->leftJoin('COUNTRY_MASTER','STATE_MASTER.COUNTRY_ID','=','COUNTRY_MASTER.COUNTRY_ID')
            ->select('COLLEGE_MASTER.*','STATE_MASTER.STATE_ID','COUNTRY_MASTER.COUNTRY_ID')
            ->where('COLLEGE_MASTER.COLLEGE_ID','=',$id)
            ->get()[0];

            $state = DB::table('STATE_MASTER')->where('STATE_MASTER.COUNTRY_ID','=',$college->COUNTRY_ID)->get();
            $city = DB::table('CITY_MASTER')->where('CITY_MASTER.STATE_ID','=',$college->STATE_ID)->get();


            $data = compact('country','state','city','college','university');

            return view('section/university/update_college')->with($data);

        } catch (Exception $e) {
            
            return view('error/404');
        }
    }

    public function createCollege(Request $request)
    {
        $college = new College();
        $college->UNIV_ID = $request['university_name'];
        $college->COLLEGE_NAME = $request['college_name'];
        $college->ADDRESS = $request['college_street'];
        $college->CITY_ID = $request['college_city'];

        if($college->save()){
            return redirect()->back()->withError("College Created Successfully !");
        }

        return back();
    }
    public function updateCollege(Request $request,$id)
    {
        $college = College::find($id);
        $college->UNIV_ID = $request['university_name'];
        $college->COLLEGE_NAME = $request['college_name'];
        $college->ADDRESS = $request['college_street'];
        $college->CITY_ID = $request['college_city'];

        if($college->save()){
            return redirect()->back()->withError("College Updated Successfully !");
        }

        return back();
    }

    public function deleteCollege($id)
    {
        $college = College::find($id)->delete();

        if($college){
            return redirect()->back()->withError("College Deleted Successfully !");
        }

        return back();
    }
}
