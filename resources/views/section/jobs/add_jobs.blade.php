@extends('layouts.home')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Add Job Post</h1>

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

    <form class="container p-4" method="post" action=" {{ route('create_job') }} ">

        @csrf

        <h4 class="text-secondary">Job Information</h4>
        <br>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="form-group col-12 col-lg-6">
                <label for="comapny_name">Company Name</label>

                <select id="comapny_name" class="form-control" name="comapny_name" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
                    @foreach ($company as $c)
                        <option value="{{$c->COMPANY_ID}}"> {{$c->COMPANY_NAME}} </option>
                    @endforeach

                </select>
            </div>
            <div class="form-group col-12 col-lg-6">
                <label for="job_role">Job Role </label>
                <input type="text" class="form-control" id="job_role" placeholder="Job Role In Company" name="job_role" required>

            </div>
            <div class="form-group col-12 col-lg-6">
                <label for="required_skill">Required Skill</label>
                <input type="text" class="form-control" id="required_skill" placeholder="ex. Java, Python" name="required_skill" required>
            </div>

            <div class="form-group col-12 col-lg-6">
                <label for="minimum_qualification">Minimum Qualification</label>
                <input type="text" class="form-control" id="minimum_qualification" placeholder="ex. BCA , MCA" name="minimum_qualification" required>
            </div>

            <div class="form-group col-6 col-lg-3">
                <label for="ssc_score">SSC Score (%)</label>
                <input type="number" class="form-control" id="ssc_score" placeholder="ex. 60" name="ssc_score" min="0" max="100" required>
            </div>
            <div class="form-group col-6 col-lg-3">
                <label for="hsc_score">HSC Score (%)</label>
                <input type="number" class="form-control" id="hsc_score" placeholder="ex. 60" name="hsc_score" min="0" max="100" required>
            </div>
            <div class="form-group col-6 col-lg-3">
                <label for="ug_score">UG Score (CGPA)</label>
                <input type="number" class="form-control" id="ug_score" placeholder="ex. 8.5" name="ug_score" min="0" max="10" required>
            </div>
            <div class="form-group col-6 col-lg-3">
                <label for="pg_score">PG Score (CGPA)</label>
                <input type="number" class="form-control" id="pg_score" placeholder="ex. 8.5" name="pg_score" min="0" max="10" required>
            </div>

        </div>
        <div class="row justify-content-center align-items-center">

            <div class="form-group col-12 col-lg-4">
                <label for="job_university">University</label>

                <select id="job_university" class="form-control" name="job_university" onchange="getCollege()" required>
                    <option value="none" selected disabled hidden>Select University</option>
                    @foreach ($university as $u)
                        
                        <option value="{{$u->UNIV_ID}}"> {{$u->UNIV_NAME}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6 col-lg-4">
                <label for="job_college">College</label>

                <select id="job_college" class="form-control" name="job_college" onchange="getDepartment()" required>
                    <option value="none" selected disabled hidden>Select College</option>
                    
                </select>
            </div>
            <div class="form-group col-6 col-lg-4">
                <label for="job_department">Department</label>

                <select id="job_department" class="form-control" name="job_department" required>
                    <option value="none" selected disabled hidden>Select Department</option>
                    
                </select>
            </div>
            
        </div>

        <div class="row justify-content-center align-items-center g-2">
            

            <div class="form-group col-6 col-lg-4">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date"  name="start_date"  required>
            </div>
            <div class="form-group col-6 col-lg-4">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date"  name="end_date" required>
            </div>

            <div class="form-group col-12 col-lg-4">
                <label for="job_status">Status</label>

                <select id="job_status" class="form-control" name="job_status"  required>
                    <option value="1">Active</option>
                    <option value="0" selected>Inactive</option>
                </select>
            </div>

            <div class="form-group col-12">
                <label for="job_description">Job Description</label>
                <textarea class="form-control" name="job_description" id="job_description" placeholder="Job description here" cols="30" rows="4"></textarea>
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
    
            var e = document.getElementById("job_university");
            var value = e.value;
    
            $('#job_college option').remove();
            $("#job_college").append('<option value="none" selected disabled >Select</option>');
    
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
                        $('#job_college').append('<option value="'+element['COLLEGE_ID']+'">'+ element['COLLEGE_NAME'] +'</option>');
                    });
    
                }
            });
        }
        
        function getDepartment() {
    
            var e = document.getElementById("job_college");
            var value = e.value;
    
            $('#job_department option').remove();
            $("#job_department").append('<option value="none" selected disabled >Select</option>');
    
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
                        $('#job_department').append('<option value="'+element['DEPT_ID']+'">'+ element['DEPT_NAME'] +'</option>');
                    });
    
                }
            });
        }
    
</script>
@endsection