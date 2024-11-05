<div class="header">
    <div class="header-left active">
        {{-- <a href="{{ route('dashboard') }}" class="logo logo-normal">
            <img src="{{ asset(getenv('LOGO')) }}" alt>
            {{ getenv('WEBSITE_NAME') }}
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-white">
            <img src="{{ asset(getenv('FAVICON_ICON')) }}" alt>
            {{ getenv('WEBSITE_NAME') }}
        </a>
        <a href="{{ route('dashboard') }}" class="logo-small">
            <img src="{{ asset(getenv('FAVICON_ICON')) }}" alt>
            {{ getenv('WEBSITE_NAME') }}
        </a> --}}
        <a id="toggle_btn" href="javascript:void(0);">
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>
    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>
    <ul class="nav user-menu">
        <li class="nav-item nav-searchinputs">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
            </div>
        </li>
   
        <li class="nav-item nav-item-box">
            <a href="javascript:void(0);" id="btnFullscreen">
                <i data-feather="maximize"></i>
            </a>
        </li>
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-info">
                    <span class="user-letter">
                        <img src="{{asset('assets/img/profiles/avator1.jpg')}}" alt class="img-fluid">
                    </span>
                    <span class="user-detail">
                        <span class="user-role">Admin</span>
                    </span>
                </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="{{ asset(getenv("FAVICON_ICON")) }}" alt>
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h5>Admin</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{route('admin.change.password')}}"><i class="me-2"
                            data-feather="settings"></i>Change-Password</a>
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href=""
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <img src="{{ asset('resources/assets/img/icons/log-out.svg') }}" class="me-2"
                            alt="img">Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </li>
    </ul>
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Logout</a>
        </div>
    </div>
</div>
