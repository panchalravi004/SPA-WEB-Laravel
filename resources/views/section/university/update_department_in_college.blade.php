@extends('layouts.home')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Update Department In College</h1>

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

    <form class="container p-2" method="post" action=" {{ route('update_department_in_college', ['id'=>$dept_In_college->ID]) }} ">
            
        @csrf

        <div class="row d-flex justify-content-left align-items-center">
            <div class="form-group col-12">
                <label for="college_name">College Name</label>
                <select class="form-control" name="college_name" id="college_name" required>
                    <option value="none" selected disabled hidden>Select</option>
                    @foreach ($college as $c)
                        @if ($dept_In_college->COLLEGE_ID == $c->COLLEGE_ID)
                        
                            <option value="{{$c->COLLEGE_ID}}" selected> {{$c->COLLEGE_NAME}} </option>
                        @else
                            <option value="{{$c->COLLEGE_ID}}"> {{$c->COLLEGE_NAME}} </option>
                            
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12">
                <label for="department_name">Department Name</label>
                <select class="form-control" name="department_name" id="department_name" required>
                    <option value="none" selected disabled hidden>Select</option>
                    @foreach ($department as $d)
                        @if ($d->DEPT_ID == $dept_In_college->DEPT_ID)
                            
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

        <div class="row justify-content-center align-items-center g-2">
            <input type="submit" value="Update" name="update" class="btn btn-primary m-2">
        </div>
    </form>

@endsection