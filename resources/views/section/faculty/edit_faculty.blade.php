@extends('layouts.home')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Update Faculty</h1>

        @if (Session::has('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{Session::get('error')}}</strong> 
            </div>
        @endif

        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Any Button
        </a>
    </div>

    <form class="container p-2" method="post" action=" {{ route('update_faculty', ['loginId'=>$faculty->LOGIN_USER_ID,'facultyId'=>$faculty->ID]) }} ">
        @csrf
        <h4 class="text-secondary">Personal Information</h4>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="form-group col-12 col-lg-4">
                <label for="faculty_id">Faculty Id </label>
                <input type="text" class="form-control" placeholder="Faculty Id" name="faculty_id" id="faculty_id" value="{{$faculty->FACULTY_ID}}" required>

            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="faculty_name">Name</label>
                <input type="text" class="form-control" placeholder="Faculty Name" name="faculty_name" id="faculty_name" value="{{$faculty->FACULTY_NAME}}" required>

            </div>
            
            <div class="form-group col-12 col-lg-4">
                <label for="faculty_email">Email</label>
                <input type="email" class="form-control" placeholder="Faculty Name" name="faculty_email" id="faculty_email" value="{{$faculty->USER_EMAIL}}" required>

            </div>
            
        </div>
        <div class="row justify-content-center align-items-center">
            

            <div class="form-group col-12 col-lg-4">
                <label for="faculty_gender">Gender</label>

                <select class="form-control" name="faculty_gender" id="faculty_gender" required>
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="M" @if($faculty->FACULTY_GENDER == "M" ) selected @else @endif>Male</option>
                    <option value="F" @if($faculty->FACULTY_GENDER == "F" ) selected @else @endif>Female</option>
                    <option value="O" @if($faculty->FACULTY_GENDER == "O" ) selected @else @endif>Other</option>
                </select>
            </div>
            
            <div class="form-group col-12 col-lg-8">
                <label for="faculty_mob_no">Mobile No.</label>
                <!-- <input type="text" pattern="[6-9]{1}[0-9]{9}" class="form-control" placeholder="Contact no of Student" name="stud_mob_no" id="id_stud_mob_no" required> -->
                <input type="text" class="form-control" placeholder="Contact no of Faculty" name="faculty_mob_no" id="faculty_mob_no" value="{{$faculty->FACULTY_MOB}}" required>
            </div>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <h4 class="text-secondary">Acadmic Details</h4>

        <div class="row justify-content-center align-items-center">
            
            <div class="form-group col-12 col-lg-4">
                <label for="faculty_university">University Name</label>

                <select class="form-control" name="faculty_university" id="faculty_university" onchange="getCollege()" required>
                    <option value="none" selected disabled hidden>Select</option>
                    @foreach ($university as $u)
                        @if ($u->UNIV_ID == $faculty->UNIV_ID)
                            
                            <option value="{{$u->UNIV_ID}}" selected> {{$u->UNIV_NAME}} </option>
                        @else
                            
                            <option value="{{$u->UNIV_ID}}"> {{$u->UNIV_NAME}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6 col-lg-4">
                <label for="faculty_college">College Name</label>

                <select class="form-control" name="faculty_college" id="faculty_college" onchange="getDepartment()" required>
                    <option value="none" selected disabled hidden>Select</option>
                    @foreach ($college as $c)
                        @if ($c->COLLEGE_ID == $faculty->COLLEGE_ID)
                            
                        <option value="{{$c->COLLEGE_ID}}" selected> {{$c->COLLEGE_NAME}} </option>
                        @else
                        
                        <option value="{{$c->COLLEGE_ID}}"> {{$c->COLLEGE_NAME}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6 col-lg-4">
                <label for="faculty_department">Department</label>

                <select class="form-control" name="faculty_department" id="faculty_department" required>
                    <option value="none" selected disabled hidden>Select</option>
                    @foreach ($dept as $d)
                        @if ($d->DEPT_ID == $faculty->DEPT_ID)
                            
                        <option value="{{$d->DEPT_ID}}" selected> {{$d->DEPT_NAME}} </option>
                        @else
                        
                        <option value="{{$d->DEPT_ID}}"> {{$d->DEPT_NAME}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <h4 class="text-secondary">Permission</h4>

        <div class="row justify-content-between align-items-center">
            
            <div class="form-group col-6 col-lg-3">
                <label for="faculty_can_update_company">Update Company</label>

                <select class="form-control" name="faculty_can_update_company" id="faculty_can_update_company" required>
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1" @if($faculty->CAN_UPDATE_COMPANY == "1") selected @else @endif>Yes</option>
                    <option value="0" @if($faculty->CAN_UPDATE_COMPANY == "0") selected @else @endif>No</option>
                </select>
            </div>

            <div class="form-group col-6 col-lg-3">
                <label for="faculty_can_make_job_post">Make Job Post</label>

                <select class="form-control" name="faculty_can_make_job_post" id="faculty_can_make_job_post" required>
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1" @if($faculty->CAN_MAKE_JOB_POST == "1") selected @else @endif>Yes</option>
                    <option value="0" @if($faculty->CAN_MAKE_JOB_POST == "0") selected @else @endif>No</option>
                </select>
            </div>
            <div class="form-group col-6 col-lg-3">
                <label for="faculty_can_reject_job_application">Reject Job Application</label>

                <select class="form-control" name="faculty_can_reject_job_application" id="faculty_can_reject_job_application" required>
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1" @if($faculty->CAN_REJECT_JOB_APPLICATION == "1") selected @else @endif>Yes</option>
                    <option value="0" @if($faculty->CAN_REJECT_JOB_APPLICATION == "0") selected @else @endif>No</option>
                </select>
            </div>
            <div class="form-group col-6 col-lg-3">
                <label for="faculty_role">Role</label>

                <select class="form-control" name="faculty_role" id="faculty_role" required>
                    <option value="FACULTY" @if($faculty->LOGIN_USER_ROLE == "FACULTY") selected @else @endif >Faculty</option>
                    <option value="ADMIN" @if($faculty->LOGIN_USER_ROLE == "ADMIN") selected @else @endif >Admin</option>
                </select>
            </div>
        </div>
        
        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <div class="row justify-content-center align-items-center g-2">
            <input type="submit" value="Update" name="insert" class="btn btn-primary m-2">
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