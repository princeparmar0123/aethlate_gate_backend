<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="JRR International for sharing products and blogs">
    {{-- <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive"> --}}
    <meta name="author" content="JRR International">
    <meta name="robots" content="noindex, nofollow">
    <title>{{getenv('WEBSITE_NAME')}}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(getenv('FAVICON_ICON')) }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/toastr/toatr.css') }}">
    <style>
        .error {
            color: red !important;
        }
    </style>
</head>
<body>
 
    <div class="main-wrapper">
        @include('backend.layouts.panels.navbar')
        @include('backend.layouts.panels.sidebar')
        @yield('content')
    </div>

    <script src="{{ asset('resources/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ asset('resources/assets/js/script.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/toastr/toastr.js') }}"></script>
    <script src="{{ asset('resources/assets/js/moment.min.js') }}"></script>
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
    @yield('page-script')
</body>
</html>
