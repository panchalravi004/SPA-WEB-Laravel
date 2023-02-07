@extends('layouts.home')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Manage University</h1>
        <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Add University
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">University</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($university as $u)
                            <tr>
                                <td>{{$u->UNIV_NAME}}</td>
                                <td>{{$u->CITY_NAME}}</td>
                                <td>{{$u->STATE_NAME}}</td>
                                <td>{{$u->COUNTRY_NAME}}</td>
                                <td>
                                    <a href="" class="btn btn-success btn-sm">
                                        <i class="fas fa-user-edit "></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="" class="btn btn-danger btn-sm">
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


    <!-- Add University Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add University</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="form-group col-12">
                        <label for="Univerity_name">University Name</label>
                        <input type="text" class="form-control" id="" placeholder="University's Name" name="univ_name" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="University_street">University Address</label>
                        <input type="text" class="form-control" id="" placeholder="University Address" name="univ_address" required>
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
                        <label for="Univ_city">City</label>

                        <select id="city_list" class="form-control" name="univ_city" required>
                            <option value="none" selected disabled hidden>Select</option>
                            
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

@endsection