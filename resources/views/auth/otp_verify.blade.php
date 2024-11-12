<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(getenv('FAVICON_ICON')) }}">
    <link rel="stylesheet" href="{{ asset('frontend/login/login.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/toastr/toatr.css') }}">
    <title>OTP|Verification</title>
    <style>
        body {
            background: #eee;
        }
        .bgWhite {
            background: white;
            box-shadow: 0px 3px 6px 0px #cacaca;
        }
        .title {
            font-weight: 600;
            margin-top: 20px;
            font-size: 24px
        }
        .customBtn {
            border-radius: 0px;
            padding: 10px;
        }
        form input {
            display: inline-block;
            width: 50px;
            height: 50px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-6
             text-center">
                <div class="row">
                    <div class="col-sm-12  bgWhite" style="margin-top: 10rem;">
                        <div class="title">
                            Verify OTP
                        </div>
                        <form action="{{ route('otp.verify') }}" method="POST" class="mt-5">
                            @csrf
                            <input class="otp"  type="text" oninput='digitValidate(this)' onkeyup='tabChange(1)'
                                maxlength=1>
                            <input class="otp"  type="text" oninput='digitValidate(this)' onkeyup='tabChange(2)'
                                maxlength=1>
                            <input class="otp"  type="text" oninput='digitValidate(this)' onkeyup='tabChange(3)'
                                maxlength=1>
                            <input class="otp"  type="text" oninput='digitValidate(this)'onkeyup='tabChange(4)'
                                maxlength=1>
                            <input class="otp"  type="text" oninput='digitValidate(this)'onkeyup='tabChange(5)'
                                maxlength=1>
                            <input class="otp"  type="text" oninput='digitValidate(this)'onkeyup='tabChange(6)'
                                maxlength=1>
                            <hr class="mt-4">
                            <input name="otp" required id="realOtp" style="display: none;" /> <!-- Hidden input field for real OTP -->
                            <button style="background: #000000!important;color:white;" type="submit"
                                class='btn btn-warning btn-block mt-4 mb-4 customBtn'>Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
 <script>
    $(document).ready(function() {
        $(".otp").on("input", function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ""));
        });
        $(".otp").on("keyup", function(event) {
            let index = $(".otp").index(this);

            if ($(this).val() !== "") {
                if (index < 5) {
                    $(".otp").eq(index + 1).focus();
                }
            } else {
                if (index > 0) {
                    $(".otp").eq(index - 1).focus();
                }
            }
        });
    });

    let otpInputs = document.querySelectorAll(".otp");
    otpInputs.forEach(function(input, index) {
        input.addEventListener("input", function() {
            let realOtp = document.getElementById("realOtp");
            realOtp.value = "";
            otpInputs.forEach(function(otpInput) {
                realOtp.value += otpInput.value;
            });
        });
    });
</script>
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

</body>
</html>
