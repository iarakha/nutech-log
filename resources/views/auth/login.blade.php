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
    <link rel="shortcut icon" type="image/png" href="images/logo/nlt_lanscape.png">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">

            @if (session()->has('success'))
            <div class="alert alert-success solid alert-end-icon alert-dismissible fade show mt-2">
                <span><i class="mdi mdi-check"></i></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                </button> {{session('success')}}
            </div>
            @endif

            @if (session()->has('error'))
            <div class="alert alert-danger solid alert-end-icon alert-dismissible fade show mt-2">
                <span><i class="mdi mdi-alert"></i></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                </button> {{session('error')}}
            </div>
            @endif


            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form" style="border-radius: 50px">
                                    <div class="text-center mb-3">
                                        <img src="{{asset('assets/images/logo/nlt_lanscape.png')}}" height="100" alt="">
                                        <p>
                                            Nutech Log Troubleshoot </p>
                                    </div>
                                    {{-- <h4 class="text-center mb-4">Sign in your account</h4> --}}
                                    <form action="{{ route('authenticate') }}" class="mb-4" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="mb-1"><strong>*Username</strong></label>
                                            <input type="text" name="username" class="form-control"
                                                placeholder="Username" autofocus required value={{old('username')}}>
                                            @error('username')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label class="mb-1"><strong>*Password</strong></label>
                                            <input type="password" name="password" class="form-control @error('password')
                                            is-invalid @enderror" placeholder=" Password" required>
                                            @error('username')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="text-center ">
                                            <button type="submit" class=" btn btn-primary btn-block">Sign
                                                In</button>
                                        </div>
                                    </form>
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
    {{-- <script src="{{ asset('assets/js/styleSwitcher.js')}}"></script> --}}
</body>

</html>