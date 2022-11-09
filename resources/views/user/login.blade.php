
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>SQM Portal</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- Basic Css files -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/metismenu.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icons.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="home-btn d-none d-sm-block">
            {{-- <a href="index.html" class="text-white"><i class="mdi mdi-home h1"></i></a> --}}
        </div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <div class="p-3">
                        <div class="float-right text-right">
                            <h4 class="font-18 mt-3 m-b-5">Welcome Back ! </h4>
                            <p class="text-muted">Sign in to continue to SQM Portal.</p>
                        </div>
                        <a href="#" class="logo-admin"><img src="{{ asset('assets/images/logo-sm.png') }}" onerror="this.onerror=null; this.remove();" height="40" alt="logo"></a>
                    </div>

                    <div class="p-3">
                        {{-- <form class="form-horizontal m-t-10" action="{{ route('user.auth') }}" method="post"> --}}
                        <form class="form-horizontal m-t-10" action="{{ route('user.auth2fa') }}" method="post">
							@method('post')
							@csrf

                            @foreach ($errors->all() as $error)
                            <div class="alert alert-warning bg-warning text-white" role="alert">
                                <strong>{{ $error }}</strong>
                            </div>
                            @endforeach

							@if (\Session::has('message'))
                                <div class="alert alert-warning bg-warning text-white" role="alert">
                                    <strong>{{ \Session::get('message') }}</strong>
                                </div>
							@endif

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" value="{{ old('username', '') }}" placeholder="Enter username" required="" autofocus="">
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter password" required="">
                            </div>

                            <div class="d-flex justify-content-between">
                                {{-- <div class="">
                                    <div class="form-group">
                                        <div class="captcha d-flex justify-content-center">
                                            <span>{!! captcha_img() !!}</span>
                                            <button type="button" class="btn btn-success ml-3"><i class="fa fa-refresh" id="refresh"></i></button>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="">
                                    <div class="form-group">
                                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                    </div>
                                </div> --}}
                            </div>

                            <div class="d-flex">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="loginAuth" id="loginAuthLDAP" value="ldap" checked>
                                <label class="form-check-label" for="loginAuthLDAP">
                                    LDAP
                                </label>
                                </div>

                                <div class="form-check ml-4">
                                    <input class="form-check-input" type="radio" name="loginAuth" id="loginAuthLocal" value="local">
                                    <label class="form-check-label" for="loginAuthLocal">
                                        Local
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row m-t-30 ml-1">
                                <div class="col-sm-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="agree" value="true" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Setuju Ketentuan Penggunaan</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                </div>

                                {{-- <!-- Button trigger modal -->
                                <div class="col-sm-6 text-right">
                                    <button type="button" class="btn btn-primary w-md waves-effect waves-light" data-toggle="modal" data-target="#exampleModal">
                                        Log In (modal)
                                    </button>
                                </div> --}}
            
                                {{-- <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="userpassword">OTP</label>
                                            <input type="password" class="form-control" name="otp" placeholder="Enter one time password sent in telegram bot" required="">
                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" >Verify</button>
                                        </div>
                                    </div>
                                    </div>
                                </div> --}}

                            </div>
                        </form>
                        <div class="form-group m-t-30 mb-0 row">
                            <div class="col-12 text-center">
                                <button id="ketentuan-sk" class="btn btn-light text-muted" data-toggle="modal" data-target="#modal-sk">Ketentuan Penggunaan</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @include('user.modal.sk')

            <div class="m-t-40 text-center text-white">
                {{-- <p>Don't have an account ? <a href="pages-register.html" class="font-600 text-white"> Signup Now </a> </p> --}}
                <p>© 2019 - 2020 SQM Portal. Crafted with <i class="mdi mdi-heart text-white"></i></p>
            </div>

        </div>
        <!-- end wrapper-page -->

        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        
        <script type="text/javascript">
        $('#refresh').click(function(){
          $.ajax({
             type:'GET',
             url:'refreshcaptcha',
             success:function(data){
                $(".captcha span").html(data.captcha);
             }
          });
        });
        </script>

        <script>
            function standby() {
                document.getElementById('gambar').src = "{{ asset('/assets/images/logo-sm.png') }}"
            }
        </script>

    </body>
</html>
