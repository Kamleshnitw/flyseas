<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flyseas | Log in</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('public/dashboard_css/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dashboard_css/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dashboard_css/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>

<body class="hold-transition login-page authentication-bg" >
    <div class="login-box">
        <div class="card">
            <div class="card-header pt-4 pb-4 text-center">
                <a href="{{ route('login') }}">
                    <span><img src="{{asset('public/frontend/assets/img/logo/logo.png')}}" alt="" height="60"></span>
                </a>
            </div>
            <div class="card-body p-4 login-card-body">
                <div class="text-center w-75 m-auto">
                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                    <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3" style="height:45px;">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="Email" style="height:45px;">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3" style="height:45px;">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" placeholder="Password" style="height:45px;">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/dashboard_css/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
</body>

</html>
