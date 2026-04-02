<!doctype html>
<html lang="en">
<head>
  <title>Dasboard &mdash; Website Template by Colorlib</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('alumni/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('alumni/css/jquery-ui.css') }}" />
  <link rel="stylesheet" href="{{ asset('alumni/css/owl.carousel.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('alumni/css/owl.theme.default.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('alumni/css/jquery.fancybox.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('alumni/css/bootstrap-datepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('alumni/css/aos.css') }}" />
  <link rel="stylesheet" href="{{ asset('alumni/css/style.css') }}" />
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  {{-- Navbar --}}
  @include('layouts.alumni1.navbar')

  {{-- Tombol Notifikasi fixed kanan atas --}}
  

  {{-- Panel Notifikasi --}}
  <style>
  /* Custom scrollbar untuk panel notifikasi */
  #offcanvasNotif::-webkit-scrollbar {
    width: 6px;
  }
  #offcanvasNotif::-webkit-scrollbar-thumb {
    background-color: rgba(0, 123, 255, 0.5);
    border-radius: 3px;
  }
  #offcanvasNotif::-webkit-scrollbar-track {
    background: #f1f1f1;
  }
</style>

<div id="offcanvasNotif"
     style="display: none; position: fixed; top: 120px; right: 20px; width: 340px; max-height: 450px; overflow-y: auto; z-index: 1050; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border-radius: 10px; background: #fff;">
  <div class="card border-0 rounded-0">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white rounded-top px-4 py-3">
      <h5 class="mb-0 fw-bold">Komentar Terbaru di Forum Anda</h5>
      <button class="btn btn-sm btn-light btn-close" aria-label="Close" onclick="document.getElementById('offcanvasNotif').style.display='none'"></button>
    </div>
    <div class="card-body px-4 py-3">
      @forelse($notif as $komentar)
        <div class="mb-3 p-3 border rounded shadow-sm bg-light">
          <small class="text-muted d-block mb-1">
            <i class="bi bi-chat-left-text me-1"></i>
            <strong>{{ $komentar->user->name }}</strong> di forum:
          </small>
          <p class="mb-1 fw-semibold text-truncate" style="max-width: 100%;">
            {{ $komentar->forum->judul }}
          </p>
          <blockquote class="blockquote mb-2 fst-italic text-secondary" style="font-size: 0.9rem;">
            “{{ \Illuminate\Support\Str::limit($komentar->isi, 120) }}”
          </blockquote>
          <a href="{{ route('forum.show', $komentar->forum->id) }}" class="btn btn-sm btn-primary btn-sm px-3">
            Lihat Forum
          </a>
        </div>
      @empty
        <p class="text-center text-muted fst-italic my-4">Belum ada komentar baru.</p>
      @endforelse
    </div>
  </div>
</div>


  {{-- Konten Utama --}}
  <main class="main py-4">
    @yield('content')
  </main>

  {{-- Footer --}}
  @include('layouts.component-front.footer')

  <!-- JS Dependencies -->
  <script src="{{ asset('alumni/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('alumni/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('alumni/js/popper.min.js') }}"></script>
  <script src="{{ asset('alumni/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('alumni/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('alumni/js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('alumni/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('alumni/js/aos.js') }}"></script>
  <script src="{{ asset('alumni/js/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('alumni/js/jquery.sticky.js') }}"></script>
  <script src="{{ asset('alumni/js/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('alumni/js/main.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggleBtn = document.getElementById('notifToggleBtn');
      const notifPanel = document.getElementById('offcanvasNotif');

      toggleBtn.addEventListener('click', function () {
        if (notifPanel.style.display === 'none' || notifPanel.style.display === '') {
          notifPanel.style.display = 'block';
        } else {
          notifPanel.style.display = 'none';
        }
      });
    });
  </script>

</body>
</html>
