@extends('layouts.home')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Add Job Post</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Any Button
        </a>
    </div>

    <form class="container p-4" method="post" action=".\dbconnection\insert_student_info.php">
        <h4 class="text-secondary">Job Information</h4>
        <br>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="form-group col-6">
                <label for="comapny_name">Company Name</label>

                <select id="comapny_name" class="form-control" name="comapny_name" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
            </div>
            <div class="form-group col-6">
                <label for="job_role">Job Role </label>
                <input type="text" class="form-control" id="job_role" placeholder="Job Role In Company" name="job_role" required>

            </div>
            <div class="form-group col-6">
                <label for="required_skill">Required Skill</label>
                <input type="text" class="form-control" id="required_skill" placeholder="ex. Java, Python" name="required_skill" required>
            </div>

            <div class="form-group col-6">
                <label for="minimum_qualification">Minimum Qualification</label>
                <input type="text" class="form-control" id="minimum_qualification" placeholder="ex. BCA , MCA" name="minimum_qualification" required>
            </div>

            <div class="form-group col-3">
                <label for="ssc_score">SSC Score (%)</label>
                <input type="number" class="form-control" id="ssc_score" placeholder="ex. 60" name="ssc_score" min="0" max="100" required>
            </div>
            <div class="form-group col-3">
                <label for="hsc_score">HSC Score (%)</label>
                <input type="number" class="form-control" id="hsc_score" placeholder="ex. 60" name="hsc_score" min="0" max="100" required>
            </div>
            <div class="form-group col-3">
                <label for="ug_score">UG Score (CGPA)</label>
                <input type="number" class="form-control" id="ug_score" placeholder="ex. 8.5" name="ug_score" min="0" max="10" required>
            </div>
            <div class="form-group col-3">
                <label for="pg_score">PG Score (CGPA)</label>
                <input type="number" class="form-control" id="pg_score" placeholder="ex. 8.5" name="pg_score" min="0" max="10" required>
            </div>

        </div>
        <div class="row justify-content-center align-items-center">

            <div class="form-group col-4">
                <label for="univesity_name">University</label>

                <select id="univesity_name" class="form-control" name="univesity_name" required>
                    <option value="none" selected disabled hidden>Select University</option>
                    
                </select>
            </div>
            <div class="form-group col-4">
                <label for="college_name">College</label>

                <select id="college_name" class="form-control" name="college_name" required>
                    <option value="none" selected disabled hidden>Select College</option>
                    
                </select>
            </div>
            <div class="form-group col-4">
                <label for="department_name">Department</label>

                <select id="department_name" class="form-control" name="department_name" required>
                    <option value="none" selected disabled hidden>Select Department</option>
                    
                </select>
            </div>
            
        </div>

        <div class="row justify-content-center align-items-center g-2">
            <div class="row justify-content-center align-items-center g-2 col-4">
                <div class="form-group col-12">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date"  name="start_date"  required>
                </div>
                <div class="form-group col-12">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date"  name="end_date" required>
                </div>
            </div>
            <div class="col-8">
                <div class="form-group col-12">
                    <label for="job_description">Job Description</label>
                    <textarea class="form-control" name="job_description" id="job_description" placeholder="Job description here" cols="30" rows="4"></textarea>
                </div>
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