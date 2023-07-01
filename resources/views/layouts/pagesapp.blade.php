<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>ComLink</title>
    <!-- Favicon -->
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        type="text/css">
    <!-- Page plugins -->
    @yield('css')
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/argon.css?v=1.0.0" type="text/css">
</head>

<body class="{{ $class ?? '' }}">
    @auth()
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @include('layouts.navbars.pagessidebar')
    @endauth

    <div class="main-content">
        @include('layouts.navbars.pagesnavbar')
        @yield('content')
    </div>

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('assets') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    @stack('js')
    <script src="{{ asset('assets') }}/vendor/clipboard/dist/clipboard.min.js"></script>

    <!-- datatables JS -->
    <script
        src="https://argon-dashboard-pro-laravel.creative-tim.com/argon/vendor/datatables.net/js/jquery.dataTables.min.js">
    </script>
    <script
        src="https://argon-dashboard-pro-laravel.creative-tim.com/argon/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js">
    </script>

    <script
        src="https://argon-dashboard-pro-laravel.creative-tim.com/argon/vendor/datatables.net-buttons/js/dataTables.buttons.min.js">
    </script>
    <script
        src="https://argon-dashboard-pro-laravel.creative-tim.com/argon/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js">
    </script>

    <script
        src="https://argon-dashboard-pro-laravel.creative-tim.com/argon/vendor/datatables.net-buttons/js/buttons.html5.min.js">
    </script>

    <script
        src="https://argon-dashboard-pro-laravel.creative-tim.com/argon/vendor/datatables.net-buttons/js/buttons.flash.min.js">
    </script>
    <script
        src="https://argon-dashboard-pro-laravel.creative-tim.com/argon/vendor/datatables.net-buttons/js/buttons.print.min.js">
    </script>

    <!-- Argon JS -->
    <script src="https://argon-dashboard-pro-laravel.creative-tim.com/argon/js/argon.js?v=1.0.0"></script>

</body>

</html>
