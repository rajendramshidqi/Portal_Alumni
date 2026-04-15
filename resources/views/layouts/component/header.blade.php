<header class="topbar modern-topbar">
    <nav class="navbar navbar-expand-md">

        {{-- LOGO --}}
        <div class="navbar-header">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <img src="{{asset('atmin/assets/images/logo-icon.png')}}" width="35" class="me-2">
                <span class="logo-text fw-bold text-white">Admin Panel</span>
            </a>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="navbar-collapse justify-content-end">

            <ul class="navbar-nav align-items-center">

                {{-- TOGGLE SIDEBAR --}}
                <li class="nav-item me-3">
                    <a class="nav-link text-white" href="javascript:void(0)">
                        <i class="mdi mdi-menu fs-4"></i>
                    </a>
                </li>

               
               

                {{-- USER --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-white"
                        href="#" data-toggle="dropdown">

                        <img src="{{asset('atmin/assets/images/users/1.jpg')}}"
                            class="rounded-circle me-2" width="35">

                        <span class="d-none d-md-block">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end shadow rounded-3">

                        <a class="dropdown-item" href="#">
                            <i class="mdi mdi-account me-2"></i> Profile
                        </a>

                        <div class="dropdown-divider"></div>

                        {{-- LOGOUT --}}
                        <a class="dropdown-item text-danger"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                            <i class="mdi mdi-logout me-2"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>

{{-- STYLE --}}
<style>
.modern-topbar {
    background: linear-gradient(90deg, #1e293b, #334155);
    padding: 10px 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* LOGO */
.logo-text {
    font-size: 18px;
    letter-spacing: 0.5px;
}

/* NAV LINK */
.nav-link {
    transition: 0.2s;
}

.nav-link:hover {
    opacity: 0.8;
}

/* NOTIF BADGE */
.notif-badge {
    position: absolute;
    top: 5px;
    right: 5px;
    background: #ef4444;
    color: white;
    font-size: 10px;
    padding: 3px 6px;
    border-radius: 50%;
}

/* DROPDOWN */
.dropdown-menu {
    border: none;
}

/* USER NAME */
.navbar .nav-link span {
    font-weight: 500;
}
</style>