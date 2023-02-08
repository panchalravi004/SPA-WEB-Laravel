@extends('layouts.home')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Manage College</h1>
        
        @if (Session::has('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{Session::get('error')}}</strong> 
            </div>
        @endif

        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Add College
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">College</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>College Name</th>
                            <th>University Name</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>College Name</th>
                            <th>University Name</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($college as $c)
                            <tr>
                                <td>{{$c->COLLEGE_NAME}}</td>
                                <td>{{$c->UNIV_NAME}}</td>
                                <td>{{$c->CITY_NAME}}</td>
                                <td>{{$c->STATE_NAME}}</td>
                                <td>{{$c->COUNTRY_NAME}}</td>
                                <td>
                                    <a href=" {{ route('view_edit_page_college', ['id'=>$c->COLLEGE_ID]) }} " class="btn btn-success btn-sm">
                                        <i class="fas fa-user-edit "></i>
                                    </a>
                                </td>
                                <td>
                                    <a href=" {{ route('delete_college', ['id'=>$c->COLLEGE_ID]) }} " onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt "></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add College Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="post" action="{{ route('create_college') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add College</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="form-group col-12">
                            <label for="university_name">University Name</label>
                            <select id="university_name" class="form-control" name="university_name" required>
                                <option value="none" selected disabled hidden>Select University</option>
                                @foreach ($university as $u)
                        
                                    <option value="{{$u->UNIV_ID}}"> {{$u->UNIV_NAME}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="college_name">College Name</label>
                            <input type="text" class="form-control" id="college_name" placeholder="College's Name" name="college_name" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="college_street">College Address</label>
                            <input type="text" class="form-control" id="college_street" placeholder="College's Address" name="college_street" required>
                        </div>
                    </div>

                    <div class="row justify-content-center align-items-center">
                        <div class="form-group col-4">
                            <label for="college_country">Country</label>
                            <select id="college_country" class="form-control" name="college_country" onchange="getState()" required>
                                <option value="none" selected disabled hidden>Select Country</option>
                                @foreach ($country as $c)
                                    <option value="{{$c->COUNTRY_ID}}"> {{$c->COUNTRY_NAME}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="college_state">State</label>

                            <select id="college_state" class="form-control" name="college_state" onchange="getCity()" required>
                                <option value="none" selected disabled hidden>Select State</option>
                                
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="college_city">City</label>

                            <select id="college_city" class="form-control" name="college_city" required>
                                <option value="none" selected disabled hidden>Select City</option>
                                
                            </select>
                        </div>

                    </div>
                        
                </div>
                <div class="modal-footer">
                    <input type="reset" value="Reset" name="reset" class="btn btn-primary">
                    <input type="submit" class="btn btn-primary" value="Save changes">
                </div>
            </form>
        </div>
    </div>

<script>


        function getState() {
    
            var e = document.getElementById("college_country");
            var value = e.value;
    
            $('#college_state option').remove();
            $("#college_state").append('<option value="none" selected disabled >Select</option>');
    
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
                        $('#college_state').append('<option value="'+element['STATE_ID']+'">'+ element['STATE_NAME'] +'</option>');
                    });
    
                }
            });
        }
    
        function getCity() {
    
            var e = document.getElementById("college_state");
            var value = e.value;
    
            $('#college_city option').remove();
            $("#college_city").append('<option value="none" selected disabled >Select</option>');
    
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
                        $('#college_city').append('<option value="'+element['CITY_ID']+'">'+ element['CITY_NAME'] +'</option>');
                    });
    
                }
            });
        }
    
</script>
@endsection