<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SPA Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center ">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border border-light shadow my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!--- bg-login-image ----->
                            <div class="col-lg-5 d-none d-lg-flex rounded" style="background-color: rgb(228, 228, 228);">
                                <div class="container ">
                                    <div class="d-flex justify-content-center align-items-center h-100">
                                        <div class="box text-center">
                                            <!-- your content goes here -->
                                            {{-- <img src="{{ url('img/admin-image.png') }}" class="rounded" width="280" height="190" alt=""> --}}
                                            <span class="badge ">
                                                <i class="fa fa-user display-2" aria-hidden="true" style="color: rgb(0, 48, 119);"></i>
                                            </span>
                                            <h3 class="p-3 badge-primary rounded" style="background-color: rgb(0, 48, 119);">ADMIN</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back Admin !</h1>
                                    </div>
                                    @if (Session::has('Fail'))
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            {{Session::get('Fail')}}
                                        </div>
                                    @endif
                                    <form class="user" method="post" action=" {{ route('do_login') }} ">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="loginId" name="loginId" aria-describedby="emailHelp"
                                                placeholder="Enter Login Id...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password">
                                        </div>
                                        
                                        <input type="submit" value="LOGIN" class="btn btn-primary btn-user btn-block">

                                        <hr>
                                        {{-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> --}}
                                    </form>
                                    {{-- <hr> --}}
                                    {{-- <div class="text-center">
                                        <a class="small" href="">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src=" {{ url('js/sb-admin-2.min.js') }} "></script>

</body>

</html>