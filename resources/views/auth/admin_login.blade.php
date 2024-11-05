
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="blogs">
    <title>JRR International</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(getenv('FAVICON_ICON')) }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/style.css') }}">
</head>
<body class="account-page">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            {{-- <img src="{{ asset(getenv('LOGO')) }}" alt="img"> --}}
                            {{ getenv('WEBSITE_NAME') }}
                        </div>
                        <a href="" class="login-logo logo-white">
                            {{ getenv('WEBSITE_NAME') }}
                            {{-- <img src="{{ asset(getenv('LOGO')) }}" alt> --}}
                        </a>
                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4>Please login to your account</h4>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">

                                    <input type="hidden" name="type" value="704" >
                                   
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <img src="{{ asset('resources/assets/img/icons/mail.svg') }}" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input id="password" type="password"
                                        class=" pass-input form-control pe-5 password-input @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password">
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="password-addon"><i
                                            class="ri-eye-fill align-middle"></i></button>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            {{-- <div class="form-login">
                                <div class="alreadyuser">
                                    @if (Route::has('password.request'))
                                        <a class=" hover-a" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Sign
                                    In</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="login-img">
                    <img src="{{ asset('resources/assets/img/login.jpg') }}" alt="img">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('resources/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/script.js') }}"></script>
</body>
</html>
