<!doctype html>
<html lang="en">

<head>
    <title>Portal Alumn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{ asset('alumni/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('alumni/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('alumni/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('alumni/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('alumni/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('alumni/css/jquery.fancybox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('alumni/css/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css')}}">

    <link rel="stylesheet" href="{{ asset('alumni/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('alumni/css/style.css') }}">

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    @include('layouts.component-front.header')

    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    @yield('content')


    @include('layouts.component-front.footer')
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

    <!-- Popper.js, diperlukan Bootstrap dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script src="{{ asset('alumni/js/main.js') }}"></script>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('active');
        }
    </script>
    <script>
        function previewImg(e) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview').src = reader.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    </script>
</body>

</html>
