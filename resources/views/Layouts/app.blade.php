<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Selfie Art
    </title>
    <link rel="shortcut icon" href="{{ asset('assets/img/selfie.jpeg') }}" type="image/jpeg">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            @include('Layouts.navbar')

            @include('Layouts.sidebar')


            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>
        </div>
    </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/index.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>

    @stack('datatables')
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>
