<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Login;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacultyController extends Controller
{
    public function index(){
        // ->leftJoin('LOGIN_MASTER', function ($join){
        //     $join->on('FACULTY_OR_TPO_MASTER.FACULTY_ID', '=', 'LOGIN_MASTER.USER_ID')
        //     ->where('LOGIN_MASTER.USER_ROLE', '=', 'FACULTY');
        // })

        try {
            
            $faculty = DB::table('FACULTY_OR_TPO_MASTER')
            ->leftJoin('COLLEGE_MASTER', 'FACULTY_OR_TPO_MASTER.COLLEGE_ID', '=', 'COLLEGE_MASTER.COLLEGE_ID')
            ->leftJoin('DEPT_MASTER', 'FACULTY_OR_TPO_MASTER.DEPT_ID', '=', 'DEPT_MASTER.DEPT_ID')
            ->leftJoin('LOGIN_MASTER','FACULTY_OR_TPO_MASTER.FACULTY_ID', '=', 'LOGIN_MASTER.USER_ID')
            ->select(
                'FACULTY_OR_TPO_MASTER.ID',
                'FACULTY_OR_TPO_MASTER.FACULTY_ID',
                'FACULTY_OR_TPO_MASTER.FACULTY_NAME',
                'COLLEGE_MASTER.COLLEGE_NAME as COLLEGE_NAME',
                'DEPT_MASTER.DEPT_NAME as DEPT_NAME',
                'LOGIN_MASTER.ID as LOGIN_USER_ID',
                'LOGIN_MASTER.USER_ROLE as LOGIN_USER_ROLE',
                'LOGIN_MASTER.USER_STATUS as USER_STATUS')
            ->get();
    
            // return $faculty;
    
            $data = compact('faculty');

            return view('section/faculty/view_faculty')->with($data);

        } catch (Exception $e) {
            return view('error/404');
        }

    }

    public function addPage(){
        try {
            
            $university = DB::table('UNIV_MASTER')->select('UNIV_MASTER.UNIV_ID','UNIV_MASTER.UNIV_NAME')->get();
            
            $data = compact('university');

            return view('section/faculty/add_faculty')->with($data);
        } catch (Exception $e) {
            return view('error/404');
        }
    }
    
    public function editPage($id){

        try {

            $university = DB::table('UNIV_MASTER')->select('UNIV_MASTER.UNIV_ID','UNIV_MASTER.UNIV_NAME')->get();
            
            $faculty = DB::table('FACULTY_OR_TPO_MASTER')
            ->leftJoin('LOGIN_MASTER','FACULTY_OR_TPO_MASTER.FACULTY_ID','=','LOGIN_MASTER.USER_ID')
            ->select('FACULTY_OR_TPO_MASTER.*','LOGIN_MASTER.ID as LOGIN_USER_ID','LOGIN_MASTER.USER_EMAIL')
            ->where('FACULTY_OR_TPO_MASTER.ID','=',$id)
            ->get()[0];

            // return $faculty;

            $college = DB::table('COLLEGE_MASTER')->where('COLLEGE_MASTER.UNIV_ID','=',$faculty->UNIV_ID)->get();
            $dept = DB::table('COLLEGE_DEPT_MASTER')
            ->leftJoin('DEPT_MASTER','COLLEGE_DEPT_MASTER.DEPT_ID','=','DEPT_MASTER.DEPT_ID')
            ->select('DEPT_MASTER.DEPT_ID','DEPT_MASTER.DEPT_NAME')
            ->where('COLLEGE_DEPT_MASTER.COLLEGE_ID','=',$faculty->COLLEGE_ID)
            ->get();

            $data = compact('university','faculty','college','dept');

            return view('section/faculty/edit_faculty')->with($data);

        } catch (Exception $e) {
            
            return view('error/404');
        }
    }

    public function createFaculty(Request $request){
        $role = "FACULTY";

        // return $request;

        $login = new Login();

        $login->USER_ROLE = $role;
        $login->USER_ID = $request['faculty_id'];
        $login->USER_PASS = md5($request['faculty_id']);
        $login->USER_EMAIL = $request['faculty_email'];
        $login->USER_STATUS = 0;

        if($login->save()){

            $faculty = new Faculty();

            $faculty->FACULTY_ID = $request['faculty_id'];
            $faculty->FACULTY_NAME = $request['faculty_name'];
            $faculty->FACULTY_GENDER = $request['faculty_gender'];
            $faculty->FACULTY_MOB = $request['faculty_mob_no'];
            $faculty->UNIV_ID = $request['faculty_university'];
            $faculty->COLLEGE_ID = $request['faculty_college'];
            $faculty->DEPT_ID = $request['faculty_department'];
            $faculty->CAN_UPDATE_COMPANY = $request['faculty_can_update_company'];
            $faculty->CAN_MAKE_JOB_POST = $request['faculty_can_make_job_post'];
            $faculty->CAN_REJECT_JOB_APPLICATION = $request['faculty_can_reject_job_application'];

            if($faculty->save()){
                return redirect()->back()->withError('Faculty Created Successfully !');
            }

        }
        
        return $request;
    }

    public function updateFaculty(Request $request,$loginId,$facultyId){
        $role = "FACULTY";

        // return $request;

        $login = Login::find($loginId);

        $login->USER_ROLE = $role;
        $login->USER_ID = $request['faculty_id'];
        $login->USER_PASS = md5($request['faculty_id']);
        $login->USER_EMAIL = $request['faculty_email'];
        // $login->USER_STATUS = 0;

        if($login->save()){

            $faculty = Faculty::find($facultyId);

            $faculty->FACULTY_ID = $request['faculty_id'];
            $faculty->FACULTY_NAME = $request['faculty_name'];
            $faculty->FACULTY_GENDER = $request['faculty_gender'];
            $faculty->FACULTY_MOB = $request['faculty_mob_no'];
            $faculty->UNIV_ID = $request['faculty_university'];
            $faculty->COLLEGE_ID = $request['faculty_college'];
            $faculty->DEPT_ID = $request['faculty_department'];
            $faculty->CAN_UPDATE_COMPANY = $request['faculty_can_update_company'];
            $faculty->CAN_MAKE_JOB_POST = $request['faculty_can_make_job_post'];
            $faculty->CAN_REJECT_JOB_APPLICATION = $request['faculty_can_reject_job_application'];

            if($faculty->save()){
                return redirect()->back()->withError('Faculty Updated Successfully !');
            }

        }
        
        return redirect()->back();
    }

    function deleteFaculty(Request $request,$loginId)
    {
        $login = Login::find($loginId)->delete();

        if($login){
            return redirect()->back()->withError("Faculty Deleted Successfully !");
        }
    }

    function updateStatusFaculty(Request $request,$loginId,$status)
    {
        $login = Login::find($loginId);

        $login->USER_STATUS = $status;

        if($login->save()){
            return json_encode("SUCCESS");
        }else{
            return json_encode("FAILD");
        }
        
    }
}
