<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jadwal Piket | Login</title>
    <link rel="icon" href="{{ asset('assets/img/sii_circle.svg') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet') }}" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        @media only screen and (max-width: 600px) {
            #img {
                display: none;

            }

            .col-4 {
                display: none;
            }

            #judul {
                display: flex;
                justify-content: center;
                align-items: center;
                justify-items: center;
                align-self: center;
            }
        }
    </style>

</head>

<body class="bg-grey">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 mt-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <div class="row mb-3">
                                            <div class="col-12 mb-3 justify-content-center">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('assets/img/sii_circle.svg') }}"
                                                            width="30%" class="float-right" id="img" />
                                                    </div>
                                                    <div class="col-8 mx-auto" id="judul">
                                                        <h3 class="float-left"><strong>Jadwal
                                                                Piket</strong></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="float-left"><strong>Sign In!</strong></h4>
                                            </div>
                                            {{-- <img src="{{asset('assets/img/sii_circle.svg')}}" width="10%" alt="">
                                            <div class="sidebar-brand-text mx-3"><h5>Jadwal Piket</h5></div> --}}
                                        </div>
                                    </div>
                                    @if ($message = Session::get('success'))
                                    @endif
                                    <form class="user" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input id="email" type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                                placeholder="Email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                name="password" placeholder="Password" required
                                                autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block user">
                                            {{ __('Login') }}
                                        </button>
                                        <div class="mt-3 text-center justify-content-center align-items-center">
                                            <div class="h6">belum punya akun?<a
                                                    href="{{ route('register') }}" class="ml-1">Sign Up</a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    @include('sweetalert::alert')
</body>

</html>
