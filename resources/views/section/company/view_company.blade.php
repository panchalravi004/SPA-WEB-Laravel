@extends('layouts.home')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">View Company</h1>

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
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Company</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Domain</th>
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
                            <th>Domain</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($company as $c)
                            
                            <tr>
                                <td>{{$c->COMPANY_NAME}}</td>
                                <td>
                                    <a href="http://{{$c->WEB_DOMAIN}}" target="blank">
                                        {{$c->WEB_DOMAIN}}
                                    </a>
                                </td>
                                <td>{{$c->CITY_NAME}}</td>
                                <td>{{$c->STATE_NAME}}</td>
                                <td>{{$c->COUNTRY_NAME}}</td>
                                <td>
                                    <a href=" {{ route('view_edit_page_company', ['id'=>$c->COMPANY_ID]) }} " class="btn btn-success btn-sm">
                                        <i class="fas fa-user-edit "></i>
                                    </a>
                                </td>
                                <td>
                                    <a href=" {{ route('delete_company', ['id'=>$c->COMPANY_ID]) }} " onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm">
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
@endsection