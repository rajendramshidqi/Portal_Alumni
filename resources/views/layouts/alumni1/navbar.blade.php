<style>
.site-navbar {
    position: sticky;
    top: 0;
    z-index: 999;
    background: linear-gradient(135deg, #dbeafe, #e0f2fe);
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
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
.nav-link {
    font-weight: 500;
    color: #333;
    position: relative;
    transition: 0.3s;
}

.nav-link:hover {
    color: #0d6efd;
}

/* User */
.user-pill {
    background: #eef3ff;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
}

/* Mobile */
.mobile-menu {
    display: none;
    flex-direction: column;
    background: #e0f2fe;
    padding: 15px;
    border-radius: 10px;
}

.mobile-menu.active {
    display: flex;
}

/* Hamburger */
.menu-toggle {
    font-size: 24px;
    cursor: pointer;
}

/* Responsive */
@media (max-width: 991px) {
    .site-navigation {
        display: none;
    }
}

/* Notif hover */
#notifToggleBtn:hover {
    transform: translateY(-2px);
    transition: 0.2s;
}
.site-menu li {
    margin-left: 20px;
}

#notifToggleBtn {
    transition: 0.3s;
}
</style>

<header class="site-navbar py-3">
  <div class="container">
    <div class="row align-items-center">

      <!-- LOGO -->
      <div class="col-6 col-xl-3">
        <h1 class="mb-0 site-logo">
          <a href="{{ url('/') }}" class="logo-text">
            🎓 Alumni<span>Hub</span>
          </a>
        </h1>
      </div>

      <!-- MENU DESKTOP -->
      <div class="col-6 col-xl-9 text-right d-none d-xl-block">
        <ul class="site-menu d-flex justify-content-end align-items-center">

          <!-- NAVIGASI -->
          <li><a href="{{ url('/') }}" class="nav-link">Home</a></li>
          <li><a href="{{ route('lowongan.index') }}" class="nav-link">Loker</a></li>
          <li><a href="{{ route('forums.index') }}" class="nav-link">Forum</a></li>

          <!-- NOTIF (TIDAK DIUBAH) -->
          <li class="ml-3">
            <button class="btn btn-link text-decoration-none position-relative" id="notifToggleBtn">
              <i class="bi bi-bell fs-5 text-secondary"></i>

              @if($notif->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ $notif->count() }}
                </span>
              @endif
            </button>
          </li>

        </ul>
      </div>

      <!-- MOBILE -->
      <div class="col-6 d-xl-none text-right">
        <span class="menu-toggle" onclick="toggleMenu()">☰</span>
      </div>

    </div>
  </div>
</header>
<div class="container d-xl-none">
    <div id="mobileMenu" class="mobile-menu mt-2">

        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('lowongan.index') }}">Loker</a>
        <a href="{{ route('forums.index') }}">Forum</a>

    </div>
</div>