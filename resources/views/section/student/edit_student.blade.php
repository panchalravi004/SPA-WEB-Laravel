@extends('layouts.home')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Update Student</h1>

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

    <form class="container p-2" method="post" action=" {{ route('update_student', ['loginId'=>$student->LOGIN_USER_ID,'studentId'=>$student->ID]) }} ">
        
        @csrf
        
        <h4 class="text-secondary">Personal Information</h4>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="form-group col-12 col-lg-4">
                <label for="student_id">Student Id </label>
                <input type="text" class="form-control" placeholder="Student Id" name="student_id" id="student_id" value="{{$student->STUD_ID}}">

            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="student_name">Name</label>
                <input type="text" class="form-control" placeholder="Student's Name" name="student_name" id="student_name" value="{{$student->STUD_NAME}}">

            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="student_email">Email</label>
                <input type="text" pattern="[^ @]*@[^ @]*" validate=":true" class="form-control" placeholder="Email" name="student_email" id="student_email" value="{{$student->USER_EMAIL}}">
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-6 col-lg-2">
                <label for="student_dob">Date Of Birth</label>
                @php
                    $dob_date =date("Y-m-d", strtotime( $student->STUD_DOB));
                @endphp
                
                <input type="date" min="1985-01-01" class="form-control" placeholder="DOB of Student" name="student_dob" id="student_dob" value="{{$dob_date}}">
            </div>

            <div class="form-group col-6 col-lg-2">
                <label for="student_gender">Gender</label>

                <select class="form-control" name="student_gender" id="student_gender" >
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="M" @if($student->STUD_GENDER=='M') selected @else  @endif>Male</option>
                    <option value="F" @if($student->STUD_GENDER=='F') selected @else  @endif>Female</option>
                    <option value="O" @if($student->STUD_GENDER=='O') selected @else  @endif>Other</option>
                </select>
            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="student_whatsapp_no">Mobile no(Whatsapp no)</label>
                <input type="text" class="form-control" placeholder="Contact Whatsapp No(Optional)" name="student_whatsapp_no" id="student_whatsapp_no">

            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="student_mob_no">Mobile No.</label>
                <!-- <input type="text" pattern="[6-9]{1}[0-9]{9}" class="form-control" placeholder="Contact no of Student" name="stud_mob_no" id="id_stud_mob_no" > -->
                <input type="text" class="form-control" placeholder="Contact no of Student" name="student_mob_no" id="student_mob_no" value="{{$student->STUD_MOB}}">
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-6 col-lg-2">
                <label for="student_country">Country</label>
                <!-- <input type="text" class="form-control" placeholder="Country Name" name="student_country" id="student_country" > -->

                <select class="form-control" name="student_country" id="student_country" onchange="getState()" >
                    <option value="none" selected disabled hidden>Select Country</option>
                    @foreach ($country as $c)

                        @if ($c->COUNTRY_ID == $student->COUNTRY_ID)
                            
                            <option value="{{$c->COUNTRY_ID}}" selected > {{$c->COUNTRY_NAME}} </option>
                        @else
                            
                            <option value="{{$c->COUNTRY_ID}}"> {{$c->COUNTRY_NAME}} </option>
                        @endif
                        
                    @endforeach

                </select>

            </div>
            <div class="form-group col-6 col-lg-2">
                <label for="student_state">State</label>

                <select class="form-control" name="student_state" id="student_state" onchange="getCity()" >
                    <option value="none" selected disabled hidden>Select State</option>
                    @foreach ($state as $s)
                        @if ($student->STATE_ID == $s->STATE_ID)
                            
                            <option value="{{$s->STATE_ID}}" selected>{{$s->STATE_NAME}}</option>
                        @else
                            
                            <option value="{{$s->STATE_ID}}">{{$s->STATE_NAME}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6 col-lg-2">
                <label for="student_city">City</label>

                <select class="form-control" name="student_city" id="student_city" >
                    <option value="none" selected disabled hidden>Select</option>
                    @foreach ($city as $c)
                        @if ($student->CITY_ID == $c->CITY_ID)
                            
                            <option value="{{$c->CITY_ID}}" selected>{{$c->CITY_NAME}}</option>
                        @else
                            
                            <option value="{{$c->CITY_ID}}">{{$c->CITY_NAME}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6 col-lg-2">
                <label for="student_pincode">Pin code</label>
                <input type="text" pattern="([1-9]{1}[0-9]{5}|[1-9]{1}[0-9]{3}\\s[0-9]{3})" class="form-control" placeholder="Pin Code" name="student_pincode" id="student_pincode" >
            </div>

            <div class="form-group col-12 col-lg-4">
                <label for="student_street">Address</label>
                <input type="text" class="form-control" placeholder="Address" name="student_street" id="student_street" value="{{$student->STUD_ADDRESS}}">
            </div>

        </div>

        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <h4 class="text-secondary">Acadmic Details</h4>

        <div class="row justify-content-center align-items-center">
            <div class="form-group col-6 col-lg-2">
                <label for="student_primary_skill">Primary Skill</label>

                <select class="form-control" name="student_primary_skill" id="student_primary_skill" >
                    <option value="none" selected disabled>Select</option>
                    @foreach ($skills as $s)
                        @if ($s->SKILL_ID == $student->PRIMARY_SKILL)
                        
                        <option value="{{$s->SKILL_ID}}" selected> {{$s->SKILL}} </option>
                        @else
                            
                        <option value="{{$s->SKILL_ID}}"> {{$s->SKILL}} </option>
                        @endif
                    @endforeach

                </select>
            </div>

            <div class="form-group col-6 col-lg-2">
                <label for="student_secondary_skill">Secondary Skill</label>

                <select class="form-control" name="student_secondary_skill" id="student_secondary_skill" >
                    <option value="none" selected disabled hidden>Select</option>
                    @foreach ($skills as $s)
                        @if ($s->SKILL_ID == $student->SECONDARY_SKILL)
                            
                        <option value="{{$s->SKILL_ID}}" selected> {{$s->SKILL}} </option>
                        @else
                            
                        <option value="{{$s->SKILL_ID}}"> {{$s->SKILL}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6 col-lg-2">
                <label for="student_tertiary_skill">Tertiary Skill</label>

                <select class="form-control" name="student_tertiary_skill" id="student_tertiary_skill" >
                    <option value="none" selected disabled>Select</option>
                    @foreach ($skills as $s)
                        @if ($s->SKILL_ID == $student->TERTIARY_SKILL)
                            
                        <option value="{{$s->SKILL_ID}}" selected> {{$s->SKILL}} </option>
                        @else
                            
                        <option value="{{$s->SKILL_ID}}"> {{$s->SKILL}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6 col-lg-2">
                <label for="student_academic_session">Academic Session</label>
                <input type="text" class="form-control" placeholder="Enter Student Acadmic Session" name="student_academic_session" id="student_academic_session" value="{{$student->ACADEMIC_SESSION}}">
            </div>
            <div class="form-group col-6 col-lg-2">
                <label for="student_session_start_month">Session Start Month</label>

                <select class="form-control" name="student_session_start_month" id="student_session_start_month" >
                    <option value="none" selected disabled>Select</option>
                    
                    @foreach (getMonths() as $key => $value)
                        @if ($key == $student->SESSION_START_MONTH)
                            
                            <option value="{{$key}}" selected>{{$value}}</option>
                        @else
                            
                            <option value="{{$key}}">{{$value}}</option>
                        @endif
                    @endforeach

                </select>
            </div>
            <div class="form-group col-6 col-lg-2">
                <label for="student_academic_level">Academic Level</label>
                <input type="text" class="form-control" placeholder="Acadmic Level" name="student_academic_level" id="student_academic_level" value="{{$student->ACADEMIC_LEVEL}}">
            </div>

        </div>

        <div class="row justify-content-center align-items-center">
            <div class="form-group col-12 col-lg-4">
                <label for="student_university">University Name</label>

                <select class="form-control" name="student_university" id="student_university" onchange="getCollege()"  >
                    <option value="none" selected disabled hidden>Select</option>
                    @foreach ($university as $u)
                        @if ($u->UNIV_ID == $student->UNIV_ID)
                            
                        <option value="{{$u->UNIV_ID}}" selected> {{$u->UNIV_NAME}} </option>
                        @else
                        
                        <option value="{{$u->UNIV_ID}}"> {{$u->UNIV_NAME}} </option>
                        @endif
                    @endforeach

                </select>
            </div>
            <div class="form-group col-6 col-lg-2">
                <label for="student_college">College Name</label>

                <select class="form-control" name="student_college" id="student_college" onchange="getDepartment()" >
                    <option value="none" selected disabled>Select</option>
                    @foreach ($college as $c)
                        @if ($c->COLLEGE_ID == $student->COLLEGE_ID)
                            
                        <option value="{{$c->COLLEGE_ID}}" selected> {{$c->COLLEGE_NAME}} </option>
                        @else
                        
                        <option value="{{$c->COLLEGE_ID}}"> {{$c->COLLEGE_NAME}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6 col-lg-2">
                <label for="student_department">Department</label>

                <select class="form-control" name="student_department" id="student_department" >
                    <option value="none" selected disabled hidden>Select</option>

                    @foreach ($dept as $d)
                        @if ($d->DEPT_ID == $student->DEPT_ID)
                            
                        <option value="{{$d->DEPT_ID}}" selected> {{$d->DEPT_NAME}} </option>
                        @else
                        
                        <option value="{{$d->DEPT_ID}}"> {{$d->DEPT_NAME}} </option>
                        @endif
                    @endforeach

                </select>
            </div>

            
            <div class="form-group col-6 col-lg-2">
                <label for="student_sem">Semester</label>

                <select class="form-control" name="student_sem" id="student_sem" >
                    <option value="none" selected disabled hidden>Select</option>
                    
                    @foreach (getSemesters() as $key => $value)
                        @if ($key == $student->SEM)
                            
                            <option value="{{$key}}" selected>{{$value}}</option>
                        @else
                            <option value="{{$key}}">{{$value}}</option>                            
                        @endif
                    @endforeach

                </select>
            </div>
            <div class="form-group col-6 col-lg-2">
                <label for="student_section">Student Section</label>
                <input type="text" class="form-control" placeholder="Student Section" name="student_section" id="student_section" value="{{$student->SECTION}}">
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
                @php
                    $ssc_score_type = explode("_",$student->SSC_SCORE)
                @endphp
            <div class="form-group col-4 col-lg-4">
                <label for="student_ssc_score_type">SSC Score In</label>
                <select class="form-control" name="student_ssc_score_type" id="student_ssc_score_type" >
                    <option value="percentage" @if($ssc_score_type[1] == "PRE") selected @endif>Percentage</option>
                    <option value="cgpa" @if($ssc_score_type[1] == "CGPA") selected @endif>CGPA</option>
                </select>
            </div>
            <div class="form-group col-4 col-lg-4">
                <label for="student_ssc_score">SSC Score</label>
                <input type="text" class="form-control" placeholder="SSC Marks" name="student_ssc_score" id="student_ssc_score" value="{{$ssc_score_type[0]}}">
            </div>
            <div class="form-group col-4 col-lg-4">
                <label for="student_ssc_year">SSC Pass Year</label>
                <input type="text" class="form-control" placeholder="SSC Pass Year" name="student_ssc_year" id="student_ssc_year" value="{{$student->SSC_PASS_YR}}">
            </div>
            
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-12 col-lg-4">
                <label for="student_hsc_stream">HSC Stream</label>
                <select class="form-control" name="student_hsc_stream" id="student_hsc_stream" >
                    <option value="none" selected disabled>Select</option>
                    @foreach ($course as $c)
                         @if ($c->COURSE_ID == $student->HSC_STREAM)
                             
                         <option value="{{$c->COURSE_ID}}" selected>{{$c->COURSE_NAME}}</option>
                         @else
                             
                         <option value="{{$c->COURSE_ID}}">{{$c->COURSE_NAME}}</option>
                         @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-4 col-lg-2">
                @php
                    $hsc_score_type = explode("_",$student->HSC_SCORE)
                @endphp

                <label for="student_hsc_score_type">HSC Score In</label>
                <select class="form-control" name="student_hsc_score_type" id="student_hsc_score_type" >
                    <option value="percentage" @if($hsc_score_type[1] == "PRE") selected @endif>Percentage</option>
                    <option value="cgpa" @if($hsc_score_type[1] == "CGPA") selected @endif>CGPA</option>
                </select>
            </div>
            <div class="form-group col-4 col-lg-3">
                <label for="student_hsc_score">HSC Score</label>
                <input type="text" class="form-control" placeholder="HSC Marks" name="student_hsc_score" id="student_hsc_score" value="{{$hsc_score_type[0]}}">
            </div>
            <div class="form-group col-4 col-lg-3">
                <label for="student_hsc_year">Hsc Pass Year</label>
                <input type="text" class="form-control" placeholder="HSC Pass Year" name="student_hsc_year" id="student_hsc_year" value="{{$student->HSC_PASS_YR}}">
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-12 col-lg-4">
                <label for="student_ug_stream">UG Stream</label>
                <select class="form-control" name="student_ug_stream" id="student_ug_stream" >
                    <option value="none" selected disabled hidden>Select</option>
                    @foreach ($course as $c)
                        @if ($c->COURSE_ID == $student->UG_STRAM)
                            
                        <option value="{{$c->COURSE_ID}}" selected>{{$c->COURSE_NAME}}</option>
                        @else
                            
                        <option value="{{$c->COURSE_ID}}">{{$c->COURSE_NAME}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-4 col-lg-2">
                <label for="student_ug_score_type">UG Score In</label>
                @php
                    $ug_score_stype = explode("_",$student->UG_SCORE)
                @endphp
                <select class="form-control" name="student_ug_score_type" id="student_ug_score_type" >
                    <option value="percentage" @if($ug_score_stype[1] == "PRE") selected @endif>Percentage</option>
                    <option value="cgpa" @if($ug_score_stype[1] == "CGPA") selected @endif>CGPA</option>
                </select>
            </div>
            <div class="form-group col-4 col-lg-3">
                <label for="student_ug_score">UG Score</label>
                
                <input type="text" class="form-control" placeholder="UG Marks" name="student_ug_score" id="student_ug_score" value="{{$ug_score_stype[0]}}">
            </div>
            <div class="form-group col-4 col-lg-3">
                <label for="student_ug_year">UG Pass Year</label>
                <input type="text" class="form-control" placeholder="UG Year" name="student_ug_year" id="student_ug_year" value="{{$student->UG_PASS_YR}}">
            </div>
            
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-12 col-lg-4">
                <label for="student_pg_stream">PG Stream</label>
                <select class="form-control" name="student_pg_stream" id="student_pg_stream" >
                    <option value="none" selected disabled hidden>Select</option>
                    @foreach ($course as $c)
                        @if ($c->COURSE_ID == $student->PG_STREAM)
                            
                        <option value="{{$c->COURSE_ID}}" selected>{{$c->COURSE_NAME}}</option>
                        @else
                            
                        <option value="{{$c->COURSE_ID}}">{{$c->COURSE_NAME}}</option>
                        @endif
                    @endforeach
                </select>

            </div>
            <div class="form-group col-4 col-lg-2">
                @php
                    $pg_score_type = explode("_",$student->PG_SCORE)
                @endphp
                <label for="student_pg_score_type">PG Score In</label>
                <select class="form-control" name="student_pg_score_type" id="student_pg_score_type" >
                    <option value="percentage" @if($pg_score_type[1] == "PRE") selected @endif>Percentage</option>
                    <option value="cgpa" @if($pg_score_type[1] == "CGPA") selected @endif>CGPA</option>
                </select>
            </div>
            <div class="form-group col-4 col-lg-2">
                <label for="student_pg_score">PG Score</label>
                
                <input type="text" class="form-control" placeholder="PG Marks" name="student_pg_score" id="student_pg_score" value="{{$pg_score_type[0]}}">
            </div>
            <div class="form-group col-4 col-lg-2">
                <label for="student_pg_year">PG Pass Year</label>
                <input type="text" class="form-control" placeholder="PG Pass Year" name="student_pg_year" id="student_pg_year" value="{{$student->PG_PASS_YR}}">
            </div>
            
        </div>
        
        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">
        
        <h4 class="text-secondary">Permission</h4>

        <div class="row justify-content-around align-items-center">
            <div class="form-group col-12 col-lg-3">
                <label for="student_can_update_sem_result">Update Sem Result</label>

                <select class="form-control" name="student_can_update_sem_result" id="student_can_update_sem_result" >

                    <option value="1" @if($student->CAN_UPDATE_SEM_RESULT == 1) selected @else @endif>Yes</option>
                    <option value="0" @if($student->CAN_UPDATE_SEM_RESULT == 0) selected @else @endif>No</option>
                </select>
            </div>

            <div class="form-group col-12 col-lg-3">
                <label for="student_can_update_profile">Can Update Profile</label>

                <select class="form-control" name="student_can_update_profile" id="student_can_update_profile" >
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="1" @if($student->CAN_UPDATE_PROFILE == 1) selected @else @endif>Yes</option>
                    <option value="0" @if($student->CAN_UPDATE_PROFILE == 0) selected @else @endif>No</option>
                </select>
            </div>
        </div>
        <!-- Divider -->
        <hr class="sidebar-divider my-0 m-4">

        <div class="row justify-content-center align-items-center g-2">
            <input type="submit" value="Update" name="submit" class="btn btn-primary m-2">
            {{-- <input type="reset" value="Reset" name="reset" class="btn btn-primary m-2"> --}}
        </div>
    </form>

<script>

    function getState() {

        var e = document.getElementById("student_country");
        var value = e.value;

        $('#student_state option').remove();
        $("#student_state").append('<option value="none" selected disabled >Select</option>');

        // console.log(value);

        $.ajax({
            type: "get",
            url: "http://127.0.0.1:8000/api/get-state-by-country/"+value,
            data: "data",
            dataType: "json",
            success: function (response) {
                // console.log(response[0]['STATE_NAME']);

                response.forEach(element => {
                    // console.log(element['STATE_NAME']);
                    $('#student_state').append('<option value="'+element['STATE_ID']+'" >'+ element['STATE_NAME'] +'</option>');
                });

            }
        });
    }

    function getCity() {

        var e = document.getElementById("student_state");
        var value = e.value;

        $('#student_city option').remove();
        $("#student_city").append('<option value="none" selected disabled >Select</option>');

        // console.log(value);

        $.ajax({
            type: "get",
            url: "http://127.0.0.1:8000/api/get-city-by-state/"+value,
            data: "data",
            dataType: "json",
            success: function (response) {
                // console.log(response[0]['CITY_NAME']);

                response.forEach(element => {
                    // console.log(element['CITY_NAME']);
                    $('#student_city').append('<option value="'+element['CITY_ID']+'">'+ element['CITY_NAME'] +'</option>');
                });

            }
        });
    }
    
    function getCollege() {

        var e = document.getElementById("student_university");
        var value = e.value;

        $('#student_college option').remove();
        $("#student_college").append('<option value="none" selected disabled >Select</option>');

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
                    $('#student_college').append('<option value="'+element['COLLEGE_ID']+'">'+ element['COLLEGE_NAME'] +'</option>');
                });

            }
        });
    }
    
    function getDepartment() {

        var e = document.getElementById("student_college");
        var value = e.value;

        $('#student_department option').remove();
        $("#student_department").append('<option value="none" selected disabled >Select</option>');

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
                    $('#student_department').append('<option value="'+element['DEPT_ID']+'">'+ element['DEPT_NAME'] +'</option>');
                });

            }
        });
    }

</script>

@endsection