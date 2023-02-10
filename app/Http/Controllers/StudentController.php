<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Models\Login;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(){

        try {
            $student = DB::table('STUDENT_MASTER')
            ->leftJoin('COLLEGE_MASTER', 'STUDENT_MASTER.COLLEGE_ID', '=', 'COLLEGE_MASTER.COLLEGE_ID')
            ->leftJoin('DEPT_MASTER', 'STUDENT_MASTER.DEPT_ID', '=', 'DEPT_MASTER.DEPT_ID')
            ->leftJoin('LOGIN_MASTER', function ($join){
                $join->on('STUDENT_MASTER.STUD_ID', '=', 'LOGIN_MASTER.USER_ID')
                ->where('LOGIN_MASTER.USER_ROLE', '=', 'STUDENT');
            })
            ->select(
                'STUDENT_MASTER.ID',
                'STUDENT_MASTER.STUD_ID',
                'STUDENT_MASTER.STUD_NAME',
                'COLLEGE_MASTER.COLLEGE_NAME as COLLEGE_NAME',
                'DEPT_MASTER.DEPT_NAME as DEPT_NAME',
                'LOGIN_MASTER.ID as LOGIN_USER_ID',
                'LOGIN_MASTER.USER_STATUS as USER_STATUS')
            ->get();
    
            // return $student;
    
            $data = compact('student');
    
            return view('section/student/view_student')->with($data);
        } catch (Exception $e) {
            return view('error/404');
        }

    }

    public function addPage(){

        try {
            
            $country = DB::table('COUNTRY_MASTER')->get();
            $skills = DB::table('SKILLS_MASTER')->get();
            $university = DB::table('UNIV_MASTER')->select('UNIV_MASTER.UNIV_ID','UNIV_MASTER.UNIV_NAME')->get();
            $course = DB::table('COURSE_MASTER')->get();

            $data = compact('country','skills','university','course');

            return view('section/student/add_student')->with($data);

        } catch (Exception $e) {
            
            return view('error/404');
        }
    }
    
    public function editPage($id){

        try {
            
            $country = DB::table('COUNTRY_MASTER')->get();
            $skills = DB::table('SKILLS_MASTER')->get();
            $university = DB::table('UNIV_MASTER')->select('UNIV_MASTER.UNIV_ID','UNIV_MASTER.UNIV_NAME')->get();
            $course = DB::table('COURSE_MASTER')->get();

            $student = DB::table('STUDENT_MASTER')
            ->leftJoin('CITY_MASTER','STUDENT_MASTER.CITY_ID','=','CITY_MASTER.CITY_ID')
            ->leftJoin('STATE_MASTER','CITY_MASTER.STATE_ID','=','STATE_MASTER.STATE_ID')
            ->leftJoin('COUNTRY_MASTER','STATE_MASTER.COUNTRY_ID','=','COUNTRY_MASTER.COUNTRY_ID')
            ->leftJoin('LOGIN_MASTER','STUDENT_MASTER.STUD_ID','=','LOGIN_MASTER.USER_ID')
            ->select('STUDENT_MASTER.*','STATE_MASTER.STATE_ID','COUNTRY_MASTER.COUNTRY_ID','LOGIN_MASTER.ID as LOGIN_USER_ID','LOGIN_MASTER.USER_EMAIL')
            ->where('STUDENT_MASTER.ID','=',$id)
            ->get()[0];

            // return $student;

            $state = DB::table('STATE_MASTER')->where('STATE_MASTER.COUNTRY_ID','=',$student->COUNTRY_ID)->get();
            $city = DB::table('CITY_MASTER')->where('CITY_MASTER.STATE_ID','=',$student->STATE_ID)->get();

            $college = DB::table('COLLEGE_MASTER')->where('COLLEGE_MASTER.UNIV_ID','=',$student->UNIV_ID)->get();
            $dept = DB::table('COLLEGE_DEPT_MASTER')
            ->leftJoin('DEPT_MASTER','COLLEGE_DEPT_MASTER.DEPT_ID','=','DEPT_MASTER.DEPT_ID')
            ->select('DEPT_MASTER.DEPT_ID','DEPT_MASTER.DEPT_NAME')
            ->where('COLLEGE_DEPT_MASTER.COLLEGE_ID','=',$student->COLLEGE_ID)
            ->get();

            $data = compact('country','state','city','skills','university','college','dept','course','student');

            return view('section/student/edit_student')->with($data);

        } catch (Exception $e) {
            
            return view('error/404');
        }
    }

    public function createStudent(Request $request){
        // Validation Of Field
        $request->validate(
            [
                'student_id'=>'required',
                'student_name'=>'required',
                'student_email'=>'required',
                'student_mob_no'=>'required',
                'student_street'=>'required',
                'student_primary_skill'=>'required',
                'student_academic_session'=>'required',
                'student_session_start_month'=>'required',
                'student_sem'=>'required',
                'student_academic_level'=>'required',
                'student_ssc_score_type'=>'required',
                'student_ssc_score'=>'required',
                'student_hsc_score'=>'required',
                'student_hsc_stream'=>'required',
                'student_ssc_year'=>'required',
                'student_ug_year'=>'required',
                'student_pg_stream'=>'required',
                'student_pg_year'=>'required',
            ]
        );
        $role = "STUDENT";

        $login = new Login();

        $login->USER_ROLE = $role;
        $login->USER_ID = $request['student_id'];
        $login->USER_PASS = md5(date("d-m-Y", strtotime($request['student_dob'])));
        $login->USER_EMAIL = $request['student_email'];
        $login->USER_STATUS = 0;

        if($login->save()){

            
            $student = new Student();
    
            $student->STUD_ID = $request['student_id'];
            $student->STUD_NAME = $request['student_name'];
            $student->STUD_GENDER = $request['student_gender'];
            $student->STUD_MOB = $request['student_mob_no'];
    
            $student->STUD_RESUME = 'path';
    
            $student->STUD_ADDRESS = $request['student_street'];
            $student->CITY_ID = $request['student_city'];
    
            $student->PRIMARY_SKILL = $request['student_primary_skill'];
            $student->SECONDARY_SKILL = $request['student_secondary_skill'];
            $student->TERTIARY_SKILL = $request['student_tertiary_skill'];
            
            $student->UNIV_ID = $request['student_university'];
            $student->COLLEGE_ID = $request['student_college'];
            $student->DEPT_ID = $request['student_department'];
            
            $student->ACADEMIC_SESSION = $request['student_academic_session'];
            $student->SESSION_START_MONTH = $request['student_session_start_month'];
            $student->SEM = $request['student_sem'];
            $student->ACADEMIC_LEVEL = $request['student_academic_level'];
    
            $student->SSC_PASS_YR = $request['student_ssc_year'];
            if ($request['student_ssc_score_type'] == "percentage") {
                
                $student->SSC_SCORE = $request['student_ssc_score']."_PRE";
    
            } else if($request['student_ssc_score_type'] == "cgpa") {
                
                $student->SSC_SCORE = $request['student_ssc_score']."_CGPA";
                
            }
    
            $student->HSC_STREAM = $request['student_hsc_stream'];
            $student->HSC_PASS_YR = $request['student_hsc_year'];
            if ($request['student_hsc_score_type'] == "percentage") {
                
                $student->HSC_SCORE = $request['student_hsc_score']."_PRE";
    
            } else if($request['student_hsc_score_type'] == "cgpa") {
                
                $student->HSC_SCORE = $request['student_hsc_score']."_CGPA";
                
            }
    
            $student->UG_STRAM = $request['student_ug_stream'];
            $student->UG_PASS_YR = $request['student_ug_year'];
            if ($request['student_ug_score_type'] == "percentage") {
                
                $student->UG_SCORE = $request['student_ug_score']."_PRE";
    
            } else if($request['student_ug_score_type'] == "cgpa") {
                
                $student->UG_SCORE = $request['student_ug_score']."_CGPA";
                
            }
    
            $student->PG_STREAM = $request['student_pg_stream'];
            $student->PG_PASS_YR = $request['student_pg_year'];
            if ($request['student_pg_score_type'] == "percentage") {
                
                $student->PG_SCORE = $request['student_pg_score']."_PRE";
    
            } else if($request['student_pg_score_type'] == "cgpa") {
                
                $student->PG_SCORE = $request['student_pg_score']."_CGPA";
                
            }
            
    
            $student->CAN_UPDATE_SEM_RESULT = $request['student_can_update_sem_result'];
            $student->CAN_UPDATE_PROFILE = $request['student_can_update_profile'];
    
            // $student->UPDATER_ID = $request[''];
    
            $student->SECTION = $request['student_section'];
    
            $student->STUD_DOB = date("d-m-Y", strtotime($request['student_dob']));
    
            if($student->save()){
    
                return redirect()->back()->withError('Student Created Successfully !');
    
            }
        }

        return back();
    }

    public function updateStudent(Request $request,$loginId,$studentId){
        $role = "STUDENT";

        $login = Login::find($loginId);

        $login->USER_ROLE = $role;
        $login->USER_ID = $request['student_id'];
        $login->USER_PASS = md5(date("d-m-Y", strtotime($request['student_dob'])));
        $login->USER_EMAIL = $request['student_email'];
        // $login->USER_STATUS = 0;

        if($login->save()){

            
            $student = Student::find($studentId);
    
            $student->STUD_ID = $request['student_id'];
            $student->STUD_NAME = $request['student_name'];
            $student->STUD_GENDER = $request['student_gender'];
            $student->STUD_MOB = $request['student_mob_no'];
    
            // $student->STUD_RESUME = 'path';
    
            $student->STUD_ADDRESS = $request['student_street'];
            $student->CITY_ID = $request['student_city'];
    
            $student->PRIMARY_SKILL = $request['student_primary_skill'];
            $student->SECONDARY_SKILL = $request['student_secondary_skill'];
            $student->TERTIARY_SKILL = $request['student_tertiary_skill'];
            
            $student->UNIV_ID = $request['student_university'];
            $student->COLLEGE_ID = $request['student_college'];
            $student->DEPT_ID = $request['student_department'];
            
            $student->ACADEMIC_SESSION = $request['student_academic_session'];
            $student->SESSION_START_MONTH = $request['student_session_start_month'];
            $student->SEM = $request['student_sem'];
            $student->ACADEMIC_LEVEL = $request['student_academic_level'];
    
            $student->SSC_PASS_YR = $request['student_ssc_year'];
            if ($request['student_ssc_score_type'] == "percentage") {
                
                $student->SSC_SCORE = $request['student_ssc_score']."_PRE";
    
            } else if($request['student_ssc_score_type'] == "cgpa") {
                
                $student->SSC_SCORE = $request['student_ssc_score']."_CGPA";
                
            }
    
            $student->HSC_STREAM = $request['student_hsc_stream'];
            $student->HSC_PASS_YR = $request['student_hsc_year'];
            if ($request['student_hsc_score_type'] == "percentage") {
                
                $student->HSC_SCORE = $request['student_hsc_score']."_PRE";
    
            } else if($request['student_hsc_score_type'] == "cgpa") {
                
                $student->HSC_SCORE = $request['student_hsc_score']."_CGPA";
                
            }
    
            $student->UG_STRAM = $request['student_ug_stream'];
            $student->UG_PASS_YR = $request['student_ug_year'];
            if ($request['student_ug_score_type'] == "percentage") {
                
                $student->UG_SCORE = $request['student_ug_score']."_PRE";
    
            } else if($request['student_ug_score_type'] == "cgpa") {
                
                $student->UG_SCORE = $request['student_ug_score']."_CGPA";
                
            }
    
            $student->PG_STREAM = $request['student_pg_stream'];
            $student->PG_PASS_YR = $request['student_pg_year'];
            if ($request['student_pg_score_type'] == "percentage") {
                
                $student->PG_SCORE = $request['student_pg_score']."_PRE";
    
            } else if($request['student_pg_score_type'] == "cgpa") {
                
                $student->PG_SCORE = $request['student_pg_score']."_CGPA";
                
            }
            
    
            $student->CAN_UPDATE_SEM_RESULT = $request['student_can_update_sem_result'];
            $student->CAN_UPDATE_PROFILE = $request['student_can_update_profile'];
    
            // $student->UPDATER_ID = $request[''];
    
            $student->SECTION = $request['student_section'];
    
            $student->STUD_DOB = date("d-m-Y", strtotime($request['student_dob']));
    
            if($student->save()){
    
                return redirect()->back()->withError('Student Updated Successfully !');
    
            }
        }

        return back();
    }

    function deleteStudent(Request $request,$loginId)
    {
        $login = Login::find($loginId)->delete();

        if($login){
            return redirect()->back()->withError("Student Deleted Successfully !");
        }
        return back();
    }

    function updateStatusStudent(Request $request,$loginId,$status)
    {
        $login = Login::find($loginId);

        $login->USER_STATUS = $status;

        if($login->save()){
            return json_encode("SUCCESS");
        }else{
            return json_encode("FAILD");
        }
        
    }

    public function importStudent()
    {
        try{

            return view('section/student/import');
            
        } catch (Exception $e) {
            return view('error/404');
        }
    }
    
    public function uploadStudent(Request $request)
    {
        Excel::import(new StudentsImport, $request->file('excel_file'));
        
        return redirect()->back()->withError('Student Imported Successfully !');
    }

    public function exportStudent()
    {
        return Excel::download(new StudentsExport, 'student.xlsx');
    }

}
