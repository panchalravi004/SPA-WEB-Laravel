<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public function index(){
        try{

            $jobs = DB::table('JOB_MASTER')
            ->leftJoin('COMPANY_MASTER','JOB_MASTER.COMPANY_ID','=','COMPANY_MASTER.COMPANY_ID')
            ->select('JOB_MASTER.JOB_ID','JOB_MASTER.ROLE','JOB_MASTER.REG_START_DATE','JOB_MASTER.REG_END_DATE','JOB_MASTER.STATUS','COMPANY_MASTER.COMPANY_NAME')
            ->get();

            $data = compact('jobs');

            return view('section/jobs/view_jobs')->with($data);
            
        }catch(Exception $e){
            return view('error/404');
        }
    }

    public function addPage(){
        try {

            

            $company = DB::table('COMPANY_MASTER')
            ->select('COMPANY_MASTER.COMPANY_ID','COMPANY_MASTER.COMPANY_NAME')
            ->get();
            $university = DB::table('UNIV_MASTER')->select('UNIV_MASTER.UNIV_ID','UNIV_MASTER.UNIV_NAME')->get();

            $data = compact('company','university');
            
            return view('section/jobs/add_jobs')->with($data);

        } catch (Exception $e) {
            
            return view('error/404');
        }
    }
    
    public function editPage($id){
        try {

            $job = DB::table('JOB_MASTER')
            ->where('JOB_MASTER.JOB_ID','=',$id)
            ->get()[0];

            $company = DB::table('COMPANY_MASTER')
            ->select('COMPANY_MASTER.COMPANY_ID','COMPANY_MASTER.COMPANY_NAME')
            ->get();
            $university = DB::table('UNIV_MASTER')->select('UNIV_MASTER.UNIV_ID','UNIV_MASTER.UNIV_NAME')->get();

            $college = DB::table('COLLEGE_MASTER')->where('COLLEGE_MASTER.UNIV_ID','=',$job->UNIV_ID)->get();
            $dept = DB::table('COLLEGE_DEPT_MASTER')
            ->leftJoin('DEPT_MASTER','COLLEGE_DEPT_MASTER.DEPT_ID','=','DEPT_MASTER.DEPT_ID')
            ->select('DEPT_MASTER.DEPT_ID','DEPT_MASTER.DEPT_NAME')
            ->where('COLLEGE_DEPT_MASTER.COLLEGE_ID','=',$job->COLLEGE_ID)
            ->get();

            $data = compact('job','company','university','college','dept');
            
            return view('section/jobs/edit_jobs')->with($data);

        } catch (Exception $e) {
            
            return view('error/404');
        }
    }

    public function createJob(Request $request)
    {
        $job = new Job();

        $job->COMPANY_ID = $request['comapny_name'];
        $job->JOB_DESC = $request['job_description'];
        $job->ROLE = $request['job_role'];
        $job->SKILLS = $request['required_skill'];
        $job->REQ_SSC_SCORE = $request['ssc_score'];
        $job->REQ_HSC_SCORE = $request['hsc_score'];
        $job->REQ_UG_SCORE = $request['ug_score'];
        $job->REQ_PG_SCORE = $request['pg_score'];
        $job->MIN_QUALIFICATION = $request['minimum_qualification'];
        $job->REG_START_DATE = $request['start_date'];
        $job->REG_END_DATE = $request['end_date'];
        $job->STATUS = $request['job_status'];
        $job->UNIV_ID = $request['job_university'];
        $job->COLLEGE_ID = $request['job_college'];
        $job->DEPT_ID = $request['job_department'];
        $job->CREATOR_ID = '12345678';

        if($job->save()){
            return redirect()->back()->withError("Job Created Successfully !");
        }

        return back();
    }
    public function updateJob(Request $request,$id)
    {
        // return $request;
        $job = Job::find($id);

        $job->COMPANY_ID = $request['comapny_name'];
        $job->JOB_DESC = $request['job_description'];
        $job->ROLE = $request['job_role'];
        $job->SKILLS = $request['required_skill'];
        $job->REQ_SSC_SCORE = $request['ssc_score'];
        $job->REQ_HSC_SCORE = $request['hsc_score'];
        $job->REQ_UG_SCORE = $request['ug_score'];
        $job->REQ_PG_SCORE = $request['pg_score'];
        $job->MIN_QUALIFICATION = $request['minimum_qualification'];
        $job->REG_START_DATE = $request['start_date'];
        $job->REG_END_DATE = $request['end_date'];
        $job->STATUS = $request['job_status'];
        $job->UNIV_ID = $request['job_university'];
        $job->COLLEGE_ID = $request['job_college'];
        $job->DEPT_ID = $request['job_department'];
        // $job->CREATOR_ID = '12345678';

        if($job->save()){
            return redirect()->back()->withError("Job Updated Successfully !");
        }

        return back();
    }

    function deleteJob(Request $request,$id)
    {
        $job = Job::find($id)->delete();

        if($job){
            return redirect()->back()->withError("Job Deleted Successfully !");
        }
    }

    function updateStatusJob(Request $request,$id,$status)
    {
        $job = Job::find($id);

        $job->STATUS = $status;

        if($job->save()){
            return json_encode("SUCCESS");
        }else{
            return json_encode("FAILD");
        }
        
    }
}
