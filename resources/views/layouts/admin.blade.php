<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="partials/plugins/fontawesome-free/css/all.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="partials/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="partials/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="partials/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="partials/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="partials/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    @stack('css')

</head>

<body class="hold-transition sidebar-mini w-full">
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.component.navbar')
        <!-- Main Sidebar Container -->
        @include('layouts.component.sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                        <div class="col-sm-4">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">@yield('breadcrumb')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>


    <!-- jQuery -->
    <script src="partials/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="partials/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="partials/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Sparkline -->
    <script src="partials/plugins/sparklines/sparkline.js"></script>
    <!-- AdminLTE App -->
    <script src="partials/dist/js/adminlte.js"></script>

    <script src="partials/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="partials/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="partials/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="partials/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="partials/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="partials/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="partials/plugins/jszip/jszip.min.js"></script>
    <script src="partials/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="partials/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="partials/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="partials/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="partials/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    @stack('js')
</body>

</html>
