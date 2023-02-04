@extends('layouts.home')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Add Company</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Any Button
        </a>
    </div>

    <form class="container p-4" method="post" action=".\dbconnection\insert_student_info.php">
        <h4 class="text-secondary">Company Information</h4>
        <br>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="form-group col-6">
                <label for="Input_Company_Id">Company Id </label>
                <input type="text" class="form-control" id="" placeholder="Company Id" name="company_id" required>

            </div>
            <div class="form-group col-6">
                <label for="Company_name">Company Name</label>
                <input type="text" class="form-control" id="" placeholder="Company's Name" name="company_name" required>
            </div>
            <div class="form-group col-6">
                <label for="HR1_name">HR1 Name</label>
                <input type="text" class="form-control" id="" placeholder="HR1's Name" name="hr1_name" required>
            </div>
            <div class="form-group col-6">
                <label for="HR1_email">HR1 Email</label>
                <input type="text" class="form-control" id="" placeholder="HR1 Email" name="hr1_email" required>
            </div>
            <div class="form-group col-6">
                <label for="HR2_name">HR2 Name</label>
                <input type="text" class="form-control" id="" placeholder="HR2's Name" name="hr2_name" required>
            </div>
            <div class="form-group col-6">
                <label for="HR2_email">HR2 Email</label>
                <input type="text" class="form-control" id="" placeholder="HR2 Email" name="hr2_email" required>
            </div>
            <div class="form-group col-6">
                <label for="About">About</label>
                <input type="text" class="form-control" id="" placeholder="About" name="about" required>
            </div>
            <div class="form-group col-6">
                <label for="Web_domain">Web Domain</label>
                <input type="url" class="form-control" id="" placeholder="Web Domain" name="web_domain" required>
            </div>
            <div class="form-group col-12">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="" placeholder="Address" name="Address" required>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="form-group col-4">
                <label for="University_country">Country</label>
                <input type="text" class="form-control" id="" placeholder="Country Name" name="univ_country" required>
            </div>
            <div class="form-group col-4">
                <label for="Univesity_state">State</label>

                <select id="state_list" class="form-control" name="univ_state" required>
                    <option value="none" selected disabled hidden>Select State</option>
                    
                </select>
            </div>
            <div class="form-group col-4">
                <label for="comapny_city">City</label>

                <select id="city_list" class="form-control" name="company_city" required>
                    <option value="none" selected disabled hidden>Select</option>
                    
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