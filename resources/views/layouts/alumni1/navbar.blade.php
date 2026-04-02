<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-6 col-xl-2">
        <h1 class="mb-0 site-logo">
          <a href="{{ url('/') }}" class="h2 mb-0">Dasboard<span class="text-primary">.</span></a>
        </h1>
      </div>
      <div class="col-12 col-md-10 d-none d-xl-block">
        <nav class="site-navigation position-relative text-right" role="navigation">
          <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
            

          
            <li>
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
        </nav>
      </div>
    </div>
  </div>
</header>
