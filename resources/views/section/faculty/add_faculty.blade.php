@extends('layouts.home')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Create Faculty</h1>

        @if (Session::has('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{Session::get('error')}}</strong> 
            </div>
        @endif

        <a href="{{ url()->previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa fa-angle-left fa-sm text-white-50"></i>
            Back
        </a>
    </div>

    <form class="container p-2" method="post" action=" {{ route('create_faculty') }} ">
        @csrf
        <h4 class="text-secondary">Personal Information</h4>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="form-group col-12 col-lg-4">
                <label for="faculty_id">Faculty Id </label>
                <input type="text" class="form-control" placeholder="Faculty Id" name="faculty_id" id="faculty_id" >
                <span class="text-danger">
                    @error('faculty_id')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="faculty_name">Name</label>
                <input type="text" class="form-control" placeholder="Faculty Name" name="faculty_name" id="faculty_name" >
                <span class="text-danger">
                    @error('faculty_name')
                        {{$message}}
                    @enderror
                </span>
            </div>
            
            <div class="form-group col-12 col-lg-4">
                <label for="faculty_email">Email</label>
                <input type="email" class="form-control" placeholder="Faculty Name" name="faculty_email" id="faculty_email" >
                <span class="text-danger">
                    @error('faculty_email')
                        {{$message}}
                    @enderror
                </span>
            </div>
            
        </div>
        <div class="row justify-content-center align-items-center">
            

            <div class="form-group col-12 col-lg-4">
                <label for="faculty_gender">Gender</label>

                <select class="form-control" name="faculty_gender" id="faculty_gender" >
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="O">Other</option>
                </select>
                <span class="text-danger">
                    @error('faculty_gender')
                        {{$message}}
                    @enderror
                </span>
            </div>
            
            <div class="form-group col-12 col-lg-8">
                <label for="faculty_mob_no">Mobile No.</label>
                <!-- <input type="text" pattern="[6-9]{1}[0-9]{9}" class="form-control" placeholder="Contact no of Student" name="stud_mob_no" id="id_stud_mob_no" > -->
                <input type="text" class="form-control" placeholder="Contact no of Faculty" name="faculty_mob_no" id="faculty_mob_no" >
                <span class="text-danger">
                    @error('faculty_mob_no')
                        {{$message}}
                    @enderror
                </span>
            </div>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <h4 class="text-secondary">Acadmic Details</h4>

        <div class="row justify-content-center align-items-center">
            
            <div class="form-group col-12 col-lg-4">
                <label for="faculty_university">University Name</label>

                <select class="form-control" name="faculty_university" id="faculty_university" onchange="getCollege()" >
                    <option value="none" selected disabled hidden>Select</option>
                    @foreach ($university as $u)
                        
                        <option value="{{$u->UNIV_ID}}"> {{$u->UNIV_NAME}} </option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('faculty_university')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-6 col-lg-4">
                <label for="faculty_college">College Name</label>

                <select class="form-control" name="faculty_college" id="faculty_college" onchange="getDepartment()" >
                    <option value="none" selected disabled hidden>Select</option>
                    
                </select>
                <span class="text-danger">
                    @error('faculty_college')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-6 col-lg-4">
                <label for="faculty_department">Department</label>

                <select class="form-control" name="faculty_department" id="faculty_department" >
                    <option value="none" selected disabled hidden>Select</option>
                </select>
                <span class="text-danger">
                    @error('faculty_department')
                        {{$message}}
                    @enderror
                </span>
            </div>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <h4 class="text-secondary">Permission</h4>

        <div class="row justify-content-between align-items-center">
            
            <div class="form-group col-6 col-lg-3">
                <label for="faculty_can_update_company">Update Company</label>

                <select class="form-control" name="faculty_can_update_company" id="faculty_can_update_company" >
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="form-group col-6 col-lg-3">
                <label for="faculty_can_make_job_post">Make Job Post</label>

                <select class="form-control" name="faculty_can_make_job_post" id="faculty_can_make_job_post" >
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group col-6 col-lg-3">
                <label for="faculty_can_reject_job_application">Reject Job Application</label>

                <select class="form-control" name="faculty_can_reject_job_application" id="faculty_can_reject_job_application" >
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group col-6 col-lg-3">
                <label for="faculty_role">Role</label>

                <select class="form-control" name="faculty_role" id="faculty_role" >
                    <option value="FACULTY" selected>Faculty</option>
                    <option value="ADMIN">Admin</option>
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

<script>
        
        function getCollege() {
    
            var e = document.getElementById("faculty_university");
            var value = e.value;
    
            $('#faculty_college option').remove();
            $("#faculty_college").append('<option value="none" selected disabled >Select</option>');
    
            // console.log(value);
    
            $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/api/get-college-by-university/"+value,
                data: "data",
                dataType: "json",
                success: function (response) {
                    // console.log(response[0]['COLLEGE_NAME']);
    
                    response.forEach(element => {
                        console.log(element['COLLEGE_NAME']);
                        $('#faculty_college').append('<option value="'+element['COLLEGE_ID']+'">'+ element['COLLEGE_NAME'] +'</option>');
                    });
    
                }
            });
        }
        
        function getDepartment() {
    
            var e = document.getElementById("faculty_college");
            var value = e.value;
    
            $('#faculty_department option').remove();
            $("#faculty_department").append('<option value="none" selected disabled >Select</option>');
    
            // console.log(value);
    
            $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/api/get-department-by-college/"+value,
                data: "data",
                dataType: "json",
                success: function (response) {
                    // console.log(response[0]['DEPT_NAME']);
    
                    response.forEach(element => {
                        console.log(element['DEPT_NAME']);
                        $('#faculty_department').append('<option value="'+element['DEPT_ID']+'">'+ element['DEPT_NAME'] +'</option>');
                    });
    
                }
            });
        }
    
</script>
@endsection