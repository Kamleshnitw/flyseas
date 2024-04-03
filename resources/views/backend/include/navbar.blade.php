<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-image: linear-gradient(to right,#45164E,#FF1499)!important;">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <div class="header-item">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a data-toggle="dropdown" href="#" aria-expanded="false" aria-haspopup="true">
            <span class="d-flex align-items-center p-3">
                <img class="rounded-circle header-profile-user" src="{{asset('public/image/user.png')}}" alt="{{Auth::user()->name}}">
                <span class="text-start ms-xl-2">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text text-center">{{Auth::user()->name}}</span>
                    <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text text-center">{{ucfirst(Auth::user()->user_type)}}</span>
                </span>
            </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
            <a href="#" class="dropdown-item">
            <i class="far fa-user mr-2"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-power-off mr-2"></i> Logout
            </a>
            </div>
        </li>

    </ul>
</div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>
