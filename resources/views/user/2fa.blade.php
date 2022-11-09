
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
                            <h4 class="font-18 mt-3 m-b-5">2FA Verification</h4>
                        </div>
                        <a href="#" class="logo-admin"><img src="{{ asset('assets/images/logo-sm.png') }}" height="26" alt="logo"></a>
                    </div>

                    <div class="p-3">
                        <form class="form-horizontal m-t-10" action="{{ route('user.tele2fa') }}" method="post">
                            @method('post')
							@csrf
                            
							<div class="form-group">
                                <label for="username">Enter Telegram ID</label>
                                <div class="card">
                                    <div class="card-body">
                                        Untuk mendapatkan Telegram ID silahkan ketikkan /start pada OSSsqmBot pada Telegram (add bot @OSSsqmBot)
                                        <br>
                                        <br>
                                        Atau klik <a href="http://t.me/OSSsqmBot" target="#">disini</a>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="telegram_id" placeholder="Enter telegram id" required="" autofocus="">
                            </div>
                            <div style="display: none">
                                <input type="text" class="form-control" name="username"  value="{{ $username }}" placeholder="Enter username" required="" autofocus="">
                                <input type="text" class="form-control" name="password"  value="{{ $password }}" placeholder="Enter password" required="" autofocus="">
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Save</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

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

    </body>
</html>

<div class="p-3">
    form verifikasi
    {{ $username }}
</div>