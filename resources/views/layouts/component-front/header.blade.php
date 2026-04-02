<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-6 col-xl-2">
        <h1 class="mb-0 site-logo">
          <a href="{{ url('/') }}" class="h2 mb-0">alumni<span class="text-primary"></span></a>
        </h1>
      </div>

      <div class="col-12 col-md-10 d-none d-xl-block">
        <nav class="site-navigation position-relative text-right" role="navigation">
          <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
            <li><a href="#home-section" class="nav-link">Home</a></li>

            <li>
              <a href="#about-section" class="nav-link">About Us</a>
             
            </li>

            <li><a href="{{ route('lowongan.index') }}" class="nav-link">Loker</a></li>
            <li><a href="{{ route('forums.index') }}" class="nav-link">Forum</a></li>

            @auth
            <li class="has-children">
              <a href="#" class="nav-link">{{ Auth::user()->name }}</a>
              <ul class="dropdown">
                <li><a href="{{ route('alumni.forums.dashboard') }}">Dashboard</a></li> 
                 <li><a href="{{ route('user.profil-awal') }}">PROFIL</a></li>
                <li>
                  <a href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
            @endauth
            
            

          </ul>
        </nav>
      </div>

      <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;">
        <a href="#" class="site-menu-toggle js-menu-toggle float-right">
          <span class="icon-menu h3"></span>
        </a>
      </div>

    </div>
  </div>
</header>
