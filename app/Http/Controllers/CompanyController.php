<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index(){
        try{

            $company = DB::table('COMPANY_MASTER')
            ->leftJoin('CITY_MASTER','COMPANY_MASTER.CITY_ID','=','CITY_MASTER.CITY_ID')
            ->leftJoin('STATE_MASTER','CITY_MASTER.STATE_ID','=','STATE_MASTER.STATE_ID')
            ->leftJoin('COUNTRY_MASTER','STATE_MASTER.COUNTRY_ID','=','COUNTRY_MASTER.COUNTRY_ID')
            ->select('COMPANY_MASTER.COMPANY_ID','COMPANY_MASTER.COMPANY_NAME','COMPANY_MASTER.WEB_DOMAIN','CITY_MASTER.CITY_NAME','STATE_MASTER.STATE_NAME','COUNTRY_MASTER.COUNTRY_NAME')
            ->get();

            $data = compact('company');

            return view('section/company/view_company')->with($data);
            
        }catch(Exception $e){

            return view('error/404');
        }
    }

    public function addPage(){

        try {
            
            $country = DB::table('COUNTRY_MASTER')->get();

            $data = compact('country');

            return view('section/company/add_company')->with($data);

        } catch (Exception $e) {
            
            return view('error/404');
        }

    }
    public function editPage($id){

        // try {
            
            $country = DB::table('COUNTRY_MASTER')->get();

            $company = DB::table('COMPANY_MASTER')
            ->leftJoin('CITY_MASTER','COMPANY_MASTER.CITY_ID','=','CITY_MASTER.CITY_ID')
            ->leftJoin('STATE_MASTER','CITY_MASTER.STATE_ID','=','STATE_MASTER.STATE_ID')
            ->leftJoin('COUNTRY_MASTER','STATE_MASTER.COUNTRY_ID','=','COUNTRY_MASTER.COUNTRY_ID')
            ->select('COMPANY_MASTER.*','STATE_MASTER.STATE_ID','COUNTRY_MASTER.COUNTRY_ID')
            ->where('COMPANY_MASTER.COMPANY_ID','=',$id)
            ->get()[0];

            // return $company;

            $state = DB::table('STATE_MASTER')->where('STATE_MASTER.COUNTRY_ID','=',$company->COUNTRY_ID)->get();
            $city = DB::table('CITY_MASTER')->where('CITY_MASTER.STATE_ID','=',$company->STATE_ID)->get();


            $data = compact('company','country','state','city');

            return view('section/company/edit_company')->with($data);

        // } catch (Exception $e) {
            
        //     return view('error/404');
        // }

    }

    public function createCompany(Request $request)
    {
        $company = new Company();

        $company->COMPANY_NAME = $request['company_name'];
        $company->HR1_NAME = $request['HR1_name'];
        $company->HR1_EMAIL = $request['HR1_email'];
        $company->HR2_NAME = $request['HR2_name'];
        $company->HR2_EMAIL = $request['HR2_email'];
        $company->ABOUT = $request['about'];
        $company->WEB_DOMAIN = $request['web_domain'];
        $company->ADDRESS = $request['address'];
        $company->CITY_ID = $request['company_city'];
        $company->CREATOR_ID = '12345678';

        if($company->save()){

            return redirect()->back()->withError("Company Created Successfully !");

        }

        return back();
    }
    
    public function updateCompany(Request $request,$id)
    {
        $company = Company::find($id);

        $company->COMPANY_NAME = $request['company_name'];
        $company->HR1_NAME = $request['HR1_name'];
        $company->HR1_EMAIL = $request['HR1_email'];
        $company->HR2_NAME = $request['HR2_name'];
        $company->HR2_EMAIL = $request['HR2_email'];
        $company->ABOUT = $request['about'];
        $company->WEB_DOMAIN = $request['web_domain'];
        $company->ADDRESS = $request['address'];
        $company->CITY_ID = $request['company_city'];
        // $company->CREATOR_ID = '12345678';

        if($company->save()){

            return redirect()->back()->withError("Company Updated Successfully !");

        }

        return back();
    }

    function deleteCompany(Request $request,$id)
    {
        $login = Company::find($id)->delete();

        if($login){
            return redirect()->back()->withError("Company Deleted Successfully !");
        }
    }
}
