<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(getenv('FAVICON_ICON')) }}">
    <link rel="stylesheet" href="{{ asset('resources/login/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/login/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/simpleline/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/login/login.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/toastr/toatr.css') }}">
    <title>{{ getenv('WEBSITE_NAME') }}</title>
</head>
<body>
    {{-- <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="form-block">
                                <div class="mb-4">
                                    <h3>Sign In to <strong>{{ getenv('WEBSITE_NAME') }}</strong></h3>
                                    <p class="mb-4">
                                        Let's sign you in.
                                    </p>
                                </div>
                                    <a href="{{route('google.login')}}" class="btn btn-pill text-white btn-block btn-primary google">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px"
                                            height="100%">
                                            <path fill="#FFC107"
                                                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                                            <path fill="#FF3D00"
                                                d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                                            <path fill="#4CAF50"
                                                d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
                                            <path fill="#1976D2"
                                                d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                                        </svg>
                                        <span class="social_name">
                                            <strong>Login with Google</strong>
                                        </span>
                                    </a>
                                    <a href="{{route('facebook.login')}}" class="btn btn-pill text-white btn-block btn-primary fb mt-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px" 
                                            height="100%">
                                            <path fill="#fff" d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z" />
                                            <path fill="#1877f2"
                                                d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z" />
                                        </svg>
                                        <span class="social_name_fb">
                                            <strong>Login with Facebook</strong>
                                        </span>
                                    </a>
                                    <span class="d-block text-center my-4 text-muted"> By joining, you agree to <a href="{{route('terms')}}"> <strong>Terms of Service </strong></a> and <a href="{{route('privacy')}}"><strong>Privacy Policy</strong></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</body>
<script src="{{ asset('resources/login/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('resources/login/js/popper.min.js') }}"></script>
<script src="{{ asset('resources/login/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('resources/login/js/main.js') }}"></script>

<script src="{{ asset('resources/assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('resources/assets/plugins/toastr/toastr.js') }}"></script>
<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
    @if (Session::has('status'))
        toastr.success("{{ Session::get('status') }}");
    @endif
    @if (Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @endif
    @if (Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif
    @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
</script>

</html>
