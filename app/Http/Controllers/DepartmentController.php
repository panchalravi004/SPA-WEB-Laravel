<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentInCollege;
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
            ->select('COLLEGE_DEPT_MASTER.ID','COLLEGE_MASTER.COLLEGE_NAME','DEPT_MASTER.DEPT_NAME')
            ->get();

            $college = DB::table('COLLEGE_MASTER')->get();

            $data = compact('department','departmentInCollege','college');

            return view('section/university/manage_department')->with($data);

        }catch(Exception $e){

            return view('error/404');
        }
    }
    public function createDepartment(Request $request)
    {
        $department = new Department();
        $department->DEPT_NAME = $request['dept_name'];

        if($department->save()){
            return redirect()->back()->withError("Department Created Successfully !");
        }

        return back();
    }

    public function editPage($id){

        try {
            
            $dept_In_college = DB::table('COLLEGE_DEPT_MASTER')
            ->leftJoin('COLLEGE_MASTER','COLLEGE_DEPT_MASTER.COLLEGE_ID','=','COLLEGE_MASTER.COLLEGE_ID')
            ->leftJoin('DEPT_MASTER','COLLEGE_DEPT_MASTER.DEPT_ID','=','DEPT_MASTER.DEPT_ID')
            ->select('COLLEGE_DEPT_MASTER.*','COLLEGE_MASTER.*','DEPT_MASTER.*')
            ->where('COLLEGE_DEPT_MASTER.ID','=',$id)
            ->get()[0];

            $department = DB::table('DEPT_MASTER')->get();
            $college = DB::table('COLLEGE_MASTER')->get();

            $data = compact('dept_In_college','department','college');

            return view('section/university/update_department_in_college')->with($data);

        } catch (Exception $e) {
            
            return view('error/404');
        }
    }
    
    public function updateDepartment(Request $request)
    {
        $department = Department::find($request['id']);
        $department->DEPT_NAME = $request['dept_name'];

        if($department->save()){
            return json_encode("SUCCESS");
        }

        return back();
    }

    public function deleteDepartment($id)
    {
        $department = Department::find($id)->delete();

        if($department){
            return redirect()->back()->withError("Department Deleted Successfully !");
        }
        return back();
    }

    public function addDepartmentInCollege(Request $request)
    {
        $departmentInCollege = new DepartmentInCollege();
        $departmentInCollege->COLLEGE_ID = $request['college_name'];
        $departmentInCollege->DEPT_ID = $request['department_name'];

        if($departmentInCollege->save()){
            return redirect()->back()->withError("Department Added Successfully !");
        }

        return back();
    }
    public function updateDepartmentInCollege(Request $request,$id)
    {
        $departmentInCollege = DepartmentInCollege::find($id);
        $departmentInCollege->COLLEGE_ID = $request['college_name'];
        $departmentInCollege->DEPT_ID = $request['department_name'];

        if($departmentInCollege->save()){
            return redirect()->back()->withError("Department Updated Successfully !");
        }

        return back();
    }

    public function removeDepartmentFromCollege($id)
    {
        $departmentInCollege = DepartmentInCollege::find($id)->delete();

        if($departmentInCollege){
            return redirect()->back()->withError("Department Removed Successfully !");
        }
        return back();
    }

}
