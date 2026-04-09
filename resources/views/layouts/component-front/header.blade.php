<style>
    /* Navbar */
    .site-navbar {
        position: sticky;
        top: 0;
        z-index: 999;
        background: linear-gradient(135deg, #dbeafe, #e0f2fe); /* biru muda */
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        padding: 15px 0;
    }

    /* Logo */
    .logo-text {
        font-size: 24px;
        font-weight: 800;
        color: #111;
        text-decoration: none;
    }

    .logo-text span {
        background: linear-gradient(45deg, #0d6efd, #6f42c1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Menu */
    .site-menu li {
        display: inline-block;
        margin: 0 12px;
    }

    .nav-link {
        position: relative;
        font-weight: 500;
        color: #333;
        transition: 0.3s;
    }

    .nav-link::after {
        content: "";
        position: absolute;
        height: 2px;
        width: 0%;
        left: 0;
        bottom: -6px;
        background: linear-gradient(45deg, #0d6efd, #6f42c1);
        transition: 0.3s;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .nav-link:hover {
        color: #0d6efd;
    }

    /* Login Button */
    .btn-login {
        padding: 8px 18px;
        background: linear-gradient(45deg, #0d6efd, #6f42c1);
        color: white !important;
        border-radius: 20px;
        font-size: 14px;
        transition: 0.3s;
    }

    /* User pill */
    .user-pill {
        background: #eef3ff;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
        color: #0d6efd !important;
    }

    /* Dropdown */
    .dropdown {
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: 0.3s;
        position: absolute;
        background: white;
        border-radius: 12px;
        padding: 10px 0;
        min-width: 180px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .has-children:hover .dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown a {
        display: block;
        padding: 10px 18px;
        color: #333;
    }

    .dropdown a:hover {
        background: #f0f4ff;
        color: #0d6efd;
    }

    /* MOBILE MENU */
    .mobile-menu {
        display: none;
        flex-direction: column;
        background: #e0f2fe;
        padding: 15px;
        border-radius: 10px;
        margin-top: 10px;
    }

    .mobile-menu a {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        color: #333;
        text-decoration: none;
    }

    .mobile-menu a:hover {
        color: #0d6efd;
    }

    /* Hamburger */
    .menu-toggle {
        font-size: 26px;
        cursor: pointer;
    }

    @media (max-width: 991px) {
        .site-navigation {
            display: none;
        }

        .mobile-menu.active {
            display: flex;
        }
    }
</style>
<header class="site-navbar js-sticky-header site-navbar-target">
    <div class="container">
        <div class="row align-items-center">

            <!-- LOGO -->
            <div class="col-6 col-xl-3">
                <h1 class="site-logo m-0">
                    <a href="{{ url('/') }}" class="logo-text">
                        🎓 Alumni<span>Hub</span>
                    </a>
                </h1>
            </div>

            <!-- MENU -->
            <div class="col-12 col-md-9 d-none d-xl-block">
                <nav class="site-navigation text-right">
                    <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">

                        <li><a href="{{ url('/') }}" class="nav-link active">Home</a></li>
                        <li><a href="{{ route('lowongan.index') }}" class="nav-link">Loker</a></li>
                        <li><a href="{{ route('forums.index') }}" class="nav-link">Forum</a></li>

                        @auth
                            <li class="has-children user-menu">
                                <a href="#" class="nav-link user-pill">
                                    👤 {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('alumni.forums.dashboard') }}">Dashboard</a></li>
                                    <li><a href="{{ route('user.profil-awal') }}">Profil</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth

                        @guest
                            <li>
                                <a href="{{ route('login') }}" class="btn-login">Login</a>
                            </li>
                        @endguest

                    </ul>
                </nav>
            </div>

            <!-- MOBILE -->
            <div class="col-6 d-xl-none text-right">
               <span class="menu-toggle" onclick="toggleMenu()">☰</span>
                    <span class="icon-menu h3"></span>
                </a>
            </div>

        </div>
    </div>
</header>
<!-- MOBILE MENU -->
<div class="container d-xl-none">
    <div id="mobileMenu" class="mobile-menu">

        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('lowongan.index') }}">Loker</a>
        <a href="{{ route('forums.index') }}">Forum</a>

        @auth
            <a href="{{ route('alumni.forums.dashboard') }}">Dashboard</a>
            <a href="{{ route('user.profil-awal') }}">Profil</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth

    </div>
</div>