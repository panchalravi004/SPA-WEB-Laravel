@extends('layouts.home')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Update Company</h1>

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

    <form class="container p-4" method="post" action=" {{ route('update_company', ['id'=>$company->COMPANY_ID]) }} ">
        
        @csrf

        <h4 class="text-secondary">Company Information</h4>
        <br>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="form-group col-12">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control" id="company_name" placeholder="Company's Name" name="company_name" value="{{$company->COMPANY_NAME}}" required>
            </div>
            <div class="form-group col-6">
                <label for="HR1_name">HR1 Name</label>
                <input type="text" class="form-control" id="HR1_name" placeholder="HR1's Name" name="HR1_name" value="{{$company->HR1_NAME}}" required>
            </div>
            <div class="form-group col-6">
                <label for="HR1_email">HR1 Email</label>
                <input type="text" class="form-control" id="HR1_email" placeholder="HR1 Email" name="HR1_email" value="{{$company->HR1_EMAIL}}" required>
            </div>
            <div class="form-group col-6">
                <label for="HR2_name">HR2 Name</label>
                <input type="text" class="form-control" id="HR2_name" placeholder="HR2's Name" name="HR2_name" value="{{$company->HR2_NAME}}" >
            </div>
            <div class="form-group col-6">
                <label for="HR2_email">HR2 Email</label>
                <input type="text" class="form-control" id="HR2_email" placeholder="HR2 Email" name="HR2_email" value="{{$company->HR2_EMAIL}}" >
            </div>
            <div class="form-group col-6">
                <label for="about">About</label>
                <input type="text" class="form-control" id="about" placeholder="About" name="about" value="{{$company->ABOUT}}" required>
            </div>
            <div class="form-group col-6">
                <label for="web_domain">Web Domain</label>
                <input type="text" class="form-control" id="web_domain" placeholder="Web Domain" name="web_domain" value="{{$company->WEB_DOMAIN}}" required>
            </div>
            <div class="form-group col-12">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="{{$company->ADDRESS}}" required>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-4">
                <label for="company_country">Country</label>
                <select id="company_country" class="form-control" name="company_country" onchange="getState()" required>
                    <option value="none" selected disabled hidden>Select Country</option>
                    @foreach ($country as $c)
                        @if ($c->COUNTRY_ID == $company->COUNTRY_ID)
                            
                            <option value="{{$c->COUNTRY_ID}}" selected> {{$c->COUNTRY_NAME}} </option>
                        @else
                            
                            <option value="{{$c->COUNTRY_ID}}"> {{$c->COUNTRY_NAME}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-4">
                <label for="company_state">State</label>

                <select id="company_state" class="form-control" name="company_state" onchange="getCity()" required>
                    <option value="none" selected disabled hidden>Select State</option>
                    @foreach ($state as $s)
                        @if ($s->STATE_ID == $company->STATE_ID)
                            
                            <option value="{{$s->STATE_ID}}" selected> {{$s->STATE_NAME}} </option>
                        @else
                            
                            <option value="{{$s->STATE_ID}}"> {{$s->STATE_NAME}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-4">
                <label for="company_city">City</label>

                <select id="company_city" class="form-control" name="company_city" required>
                    <option value="none" selected disabled hidden>Select City</option>
                    @foreach ($city as $c)
                        @if ($c->CITY_ID == $company->CITY_ID)
                            
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
            <input type="submit" value="Submit" name="insert" class="btn btn-primary m-2">
            <input type="reset" value="Reset" name="reset" class="btn btn-primary m-2">
        </div>

    </form>


<script>


    function getState() {

        var e = document.getElementById("company_country");
        var value = e.value;

        $('#company_state option').remove();
        $("#company_state").append('<option value="none" selected disabled >Select</option>');

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
                    $('#company_state').append('<option value="'+element['STATE_ID']+'">'+ element['STATE_NAME'] +'</option>');
                });

            }
        });
    }

    function getCity() {

        var e = document.getElementById("company_state");
        var value = e.value;

        $('#company_city option').remove();
        $("#company_city").append('<option value="none" selected disabled >Select</option>');

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
                    $('#company_city').append('<option value="'+element['CITY_ID']+'">'+ element['CITY_NAME'] +'</option>');
                });

            }
        });
    }

</script>
@endsection