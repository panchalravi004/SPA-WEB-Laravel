@extends('layouts.home')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Import Users</h1>

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

    {{-- Alert Messages --}}
    {{-- @include('common.alert') --}}
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Import Users</h6>
        </div>
        <form method="POST" action=" {{ route('upload_student') }} " enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    
                    <div class="col-md-12 mb-3 mt-3">
                        <p>Please Upload CSV in Given Format <a href="{{ url('file/sample-data.xlsx') }}" target="_blank">Sample CSV Format</a></p>
                    </div>
                    {{-- File Input --}}
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>File Input(Datasheet)</label>
                        <input type="file" class="form-control form-control-user"id="exampleFile"name="excel_file">
                        {{-- <span class="text-danger">
                            @error('excel_file')
                            {{$message}}
                            @enderror
                        </span> --}}

                         {{-- @error('file')
                            <span class="text-danger">{{$message}}</span>
                        @enderror  --}}
                       @if (count($errors) > 0)

                        <span class="text-danger">
                            @foreach($errors->all() as $message)

                            {{$message}} <br>

                          @endforeach  

                        </span> 
                        @endif
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Upload Users</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="">Cancel</a>
            </div>
        </form>
    </div>

</div>

@endsection