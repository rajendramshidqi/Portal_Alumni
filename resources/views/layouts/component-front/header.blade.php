<style>
  /* Navbar */
.site-navbar {
  position: sticky;
  top: 0;
  z-index: 999;
  background: linear-gradient(135deg, rgba(255,255,255,0.8), rgba(240,244,255,0.8));
  backdrop-filter: blur(12px);
  box-shadow: 0 8px 30px rgba(0,0,0,0.05);
  padding: 15px 0;
}

/* Logo */
.logo-text {
  font-size: 26px;
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
  color: #444;
  transition: 0.3s;
}

/* Hover underline animation */
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

.btn-login:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(13,110,253,0.3);
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
  transform: translateY(15px);
  transition: 0.3s;
  position: absolute;
  background: white;
  border-radius: 12px;
  padding: 10px 0;
  min-width: 180px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
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
  transition: 0.2s;
}

.dropdown a:hover {
  background: #f0f4ff;
  color: #0d6efd;
}

/* Smooth hover scale */
.site-menu li:hover {
  transform: translateY(-1px);
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
        <a href="#" class="site-menu-toggle js-menu-toggle">
          <span class="icon-menu h3"></span>
        </a>
      </div>

    </div>
  </div>
</header>