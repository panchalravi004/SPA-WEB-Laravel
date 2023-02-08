@extends('layouts.home')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Manage Department</h1>

    <a href="" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#showDepartment">
        <i class="fa fa-eye fa-sm text-white-50" aria-hidden="true"></i>
        Show Department
    </a>
    <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter">
        <i class="fas fa-plus fa-sm text-white-50"></i>
        Add Department
    </a>
    <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter2">
        <i class="fas fa-plus fa-sm text-white-50"></i>
        Add Department In College
    </a>
</div>

    <!-- Department DataTales Example -->
    {{-- <div class="card shadow mb-4 ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Department</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($department as $d)
                            <tr>
                                <td>{{$d->DEPT_NAME}}</td>
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
    </div> --}}
    <!-- Department in college DataTales Example -->
    <div class="card shadow mb-4 ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Department In College</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>College Name</th>
                            <th>Department Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>College Name</th>
                            <th>Department Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($departmentInCollege as $d)
                            <tr>
                                <td>{{$d->COLLEGE_NAME}}</td>
                                <td>{{$d->DEPT_NAME}}</td>
                                <td>
                                    <a href=" {{ route('view_edit_page_dept_in_college', ['id'=>$d->ID]) }} " class="btn btn-success btn-sm">
                                        <i class="fas fa-user-edit "></i>
                                    </a>
                                </td>
                                <td>
                                    <a href=" {{ route('remove_department_from_college', ['id'=>$d->ID]) }} " onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm">
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



<!-- Show Department Modal -->
<div class="modal fade" id="showDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content card shadow mb-4 ">
            <div class="modal-header card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Department</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-primary" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableDepartment" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Department Name</th>
                                <th>Action</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Department Name</th>
                                <th>Action</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($department as $d)
                                <tr>
                                    <td>
                                        <label hidden>{{$d->DEPT_NAME}}</label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <button class="btn btn-outline-primary" type="button" onclick="enableDepartmentNameInput('department-name-input-{{ $loop->index }}')">
                                                <i class="fas fa-pen"></i>
                                              </button>
                                            </div>
                                            <input type="text" class="form-control" id="department-name-input-{{ $loop->index }}"  aria-describedby="basic-addon1" value="{{$d->DEPT_NAME}}" disabled>
                                        </div>
                                    </td>
                                    {{-- <td>{{$d->DEPT_NAME}}</td> --}}
                                    <td>
                                        <a class="btn btn-success btn-sm" onclick="updateDepartment('department-name-input-{{ $loop->index }}','{{$d->DEPT_ID}}')" >
                                            UPDATE
                                        </a>
                                    </td>
                                    <td>
                                        <a href=" {{ route('delete_department', ['id'=>$d->DEPT_ID]) }} " onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm">
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
    </div>
</div>


<!-- Add Department Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="post" action=" {{ route('create_department') }} ">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row d-flex justify-content-left align-items-center">
                    <div class="form-group col-12">
                        <label for="department_name">Department Name</label>
                        <input type="text" class="form-control" id="" placeholder="Department's Name" name="dept_name" required>
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

<!-- Add Department In College Modal -->
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter2Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="post" action="{{ route('add_department_in_college') }}">
            
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Department In College</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row d-flex justify-content-left align-items-center">
                    <div class="form-group col-12">
                        <label for="college_name">College Name</label>
                        <select class="form-control" name="college_name" id="college_name" required>
                            <option value="none" selected disabled hidden>Select</option>
                            @foreach ($college as $c)
                                <option value="{{$c->COLLEGE_ID}}"> {{$c->COLLEGE_NAME}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="department_name">Department Name</label>
                        <select class="form-control" name="department_name" id="department_name" required>
                            <option value="none" selected disabled hidden>Select</option>
                            @foreach ($department as $d)
                                <option value="{{$d->DEPT_ID}}"> {{$d->DEPT_NAME}} </option>
                            @endforeach
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

<!-- Script  --->

<script>

    function enableDepartmentNameInput(inputId) {
        var a = document.getElementById(inputId).disabled;
        if (a) {
            document.getElementById(inputId).disabled = false;
        } else {
            document.getElementById(inputId).disabled = true;
        }
    }


    function updateDepartment(inputId,id) {
        var input = document.getElementById(inputId);

        var object = {
            "id":id,
            "dept_name":input.value
        }

        $.ajax({
            type: "get",
            url: "http://127.0.0.1:8000/Department/update",
            data: object,
            dataType: "json",
            success: function (response) {
                console.log(response);
                document.getElementById(inputId).disabled = true;
            }
        });
    }

</script>

@endsection