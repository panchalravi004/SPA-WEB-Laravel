@extends('layouts.home')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Create Faculty</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Any Button
        </a>
    </div>

    <form class="container p-2" method="post" action=".\dbconnection\insert_student_info.php">
        <h4 class="text-secondary">Personal Information</h4>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="form-group col-6">
                <label for="Input_College_Id">Faculty Id </label>
                <input type="text" class="form-control" placeholder="Faculty Id" name="stud_id" id="id_stud_id" required>

            </div>
            <div class="form-group col-6">
                <label for="Student_name">Name</label>
                <input type="text" class="form-control" placeholder="Student's Name" name="stud_name" id="id_stud_name" required>

            </div>
            
        </div>
        <div class="row justify-content-center align-items-center">
            

            <div class="form-group col-4">
                <label for="Student_gender">Gender</label>

                <select class="form-control" name="stud_gender" id="id_stud_gender" required>
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="othera">Other</option>
                </select>
            </div>
            
            <div class="form-group col-8">
                <label for="Student_mob_no">Mobile No.</label>
                <!-- <input type="text" pattern="[6-9]{1}[0-9]{9}" class="form-control" placeholder="Contact no of Student" name="stud_mob_no" id="id_stud_mob_no" required> -->
                <input type="text" class="form-control" placeholder="Contact no of Faculty" name="stud_mob_no" id="id_stud_mob_no" required>
            </div>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <h4 class="text-secondary">Acadmic Details</h4>

        <div class="row justify-content-center align-items-center">
            
            <div class="form-group col-4">
                <label for="Student_email">University Name</label>

                <select class="form-control" name="univ_name" id="id_univ_name" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
            </div>
            <div class="form-group col-4">
                <label for="Student_email">College Name</label>

                <select class="form-control" name="college_name" id="id_college_name" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
            </div>
            <div class="form-group col-4">
                <label for="Student_dob">Department</label>

                <select class="form-control" name="stud_coll_dept_id" id="id_stud_coll_dept_id" required>
                    <option value="none" selected disabled hidden>Select</option>
                </select>
            </div>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <h4 class="text-secondary">Permission</h4>

        <div class="row justify-content-between align-items-center">
            
            <div class="form-group col-3">
                <label for="Student_street">Update Company</label>

                <select class="form-control" name="stud_can_u_result" id="id_stud_can_u_result" required>
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="form-group col-3">
                <label for="Student_city">Make Job Post</label>

                <select class="form-control" name="stud_u_profile" id="id_stud_u_profile" required>
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="Student_city">Reject Job Application</label>

                <select class="form-control" name="stud_u_profile" id="id_stud_u_profile" required>
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        
        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <div class="row justify-content-center align-items-center g-2">
            <input type="submit" value="Submit" name="insert" class="btn btn-primary m-2">
            <input type="reset" value="Reset" name="reset" class="btn btn-primary m-2">
        </div>
    </form>
@endsection