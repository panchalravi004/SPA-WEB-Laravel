@extends('layouts.home')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">View Jobs</h1>

        @if (Session::has('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{Session::get('error')}}</strong> 
            </div>
        @endif

        <!----Spinner Loading---->

        <div class="row justify-content-center align-items-center g-2" style="display: none;" id="spinner">
            <div class="spinner-border text-primary" id="spinner" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="col text-primary" id="spinner-label">status label</div>
        </div>

        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jobs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Role</th>
                            <th>Start On</th>
                            <th>End On</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Company Name</th>
                            <th>Role</th>
                            <th>Start On</th>
                            <th>End On</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($jobs as $j)
                            
                            <tr>
                                <td>{{$j->COMPANY_NAME}}</td>
                                <td>{{$j->ROLE}}</td>
                                <td>{{$j->REG_START_DATE}}</td>
                                <td>{{$j->REG_END_DATE}}</td>
                                <td>
                                    <input type="checkbox" name="job_status" id="job-status-{{$loop->index}}" onchange="updateStatus({{ $loop->index }},{{$j->JOB_ID}})"  @if ($j->STATUS) value="1" checked @else value="0" @endif>
                                    <label for="" hidden>@if ($j->STATUS) Active @else Inactive @endif</label>
                                </td>
                                <td>
                                    <a href=" {{ route('view_edit_page_jobs', ['id'=>$j->JOB_ID]) }} " class="btn btn-success btn-sm">
                                        <i class="fas fa-user-edit "></i>
                                    </a>
                                </td>
                                <td>
                                    <a href=" {{ route('delete_job', ['id'=>$j->JOB_ID]) }} " onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm">
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

    <script>

        function updateStatus(index,id) {
    
            var spinner_label = document.getElementById("spinner-label");
            var spinner = document.getElementById("spinner");
    
            spinner_label.innerHTML = "Updating Status !"
    
            $("#spinner").css({
                "display":"flex"
            });
            
            var a = document.getElementById("job-status-"+index).checked;
            // alert(a);
    
            if(a){
                var status = 1;
            }else{
                var status = 0;
            }
    
            $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/Jobs/update-status/"+id+"/"+status,
                dataType: "json",
                success: function (response) {
                    console.log(response);
    
                    $("#spinner").css({
                        "display":"none"
                    });
                }
            });
    
        }
    
</script>
@endsection