<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PAGE TITLE HERE -->
    <title>{{$title}}</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/favicon.png')}}">

    <link rel="stylesheet" href="{{asset('assets/vendor/select2/css/select2.min.css')}}">
    <link href="{{asset('assets/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.html"><img src="images/logo-full.png" alt=""></a>
                                    </div>
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <form action="/sign-up/register" method="POST">
                                        @csrf
                                        <div class=" mb-3">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" name="username" class="form-control"
                                                placeholder="Masuakan username" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Name</strong></label>
                                            <input type="name" name="name" class="form-control"
                                                placeholder="Masukan nama anda" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Masukan email anda" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="mb-1"><strong>Role</strong></label>
                                            <select name="role" class="default-select wide form-control mb-2"
                                                id="validationCustom05" required>
                                                <option data-display="Pilih role">Please select</option>
                                                <option value="superadmin">Superadmin</option>
                                                <option value="cs">CS</option>
                                                <option value="teknisi">Teknisi</option>
                                                <option value="it">IT</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-2">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password" required>
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Sudah punya akun? <a class="text-primary" href="{{ route('sign-in') }}">Login
                                                disini</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
	Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins-init/select2-init.js')}}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/js/dlabnav-init.js')}}"></script>
    <script src="{{asset('assets/js/demo.js')}}"></script>
    {{-- <script src="{{asset('assets/js/styleSwitcher.js')}}"></script> --}}
</body>

</html>