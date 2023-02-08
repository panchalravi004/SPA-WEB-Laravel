@extends('layouts.home')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Update College</h1>

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

    <form class="container p-2" method="post" action=" {{ route('update_college', ['id'=>$college->COLLEGE_ID]) }} ">
            
        @csrf

        <div class="row d-flex justify-content-center align-items-center">
            <div class="form-group col-12">
                <label for="university_name">University Name</label>
                <select id="university_name" class="form-control" name="university_name" required>
                    <option value="none" selected disabled hidden>Select University</option>
                    @foreach ($university as $u)
                        @if ($u->UNIV_ID == $college->UNIV_ID)
                            
                            <option value="{{$u->UNIV_ID}}" selected> {{$u->UNIV_NAME}} </option>
                        @else
                            
                            <option value="{{$u->UNIV_ID}}"> {{$u->UNIV_NAME}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12">
                <label for="college_name">College Name</label>
                <input type="text" class="form-control" id="college_name" placeholder="College's Name" name="college_name" value="{{$college->COLLEGE_NAME}}" required>
            </div>
            <div class="form-group col-12">
                <label for="college_street">College Address</label>
                <input type="text" class="form-control" id="college_street" placeholder="College's Address" name="college_street" value="{{$college->ADDRESS}}" required>
            </div>
        </div>

        <div class="row justify-content-center align-items-center">
            <div class="form-group col-4">
                <label for="college_country">Country</label>
                <select id="college_country" class="form-control" name="college_country" onchange="getState()" required>
                    <option value="none" selected disabled hidden>Select Country</option>
                    @foreach ($country as $c)
                        @if ($c->COUNTRY_ID == $college->COUNTRY_ID)
                            
                            <option value="{{$c->COUNTRY_ID}}" selected> {{$c->COUNTRY_NAME}} </option>
                        @else
                            
                            <option value="{{$c->COUNTRY_ID}}"> {{$c->COUNTRY_NAME}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-4">
                <label for="college_state">State</label>

                <select id="college_state" class="form-control" name="college_state" onchange="getCity()" required>
                    <option value="none" selected disabled hidden>Select State</option>
                    @foreach ($state as $s)
                        @if ($s->STATE_ID == $college->STATE_ID)
                            
                            <option value="{{$s->STATE_ID}}" selected> {{$s->STATE_NAME}} </option>
                        @else
                            
                            <option value="{{$s->STATE_ID}}"> {{$s->STATE_NAME}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-4">
                <label for="college_city">City</label>

                <select id="college_city" class="form-control" name="college_city" required>
                    <option value="none" selected disabled hidden>Select City</option>
                    @foreach ($city as $c)
                        @if ($c->CITY_ID == $college->CITY_ID)
                            
                            <option value="{{$c->CITY_ID}}" selected> {{$c->CITY_NAME}} </option>
                        @else
                            
                            <option value="{{$c->CITY_ID}}"> {{$c->CITY_NAME}} </option>
                        @endif
                    @endforeach
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