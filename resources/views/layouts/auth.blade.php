<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Login</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="partials/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="partials/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="partials/dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="hold-transition login-page">

    @yield('login')

    <script src="partials/plugins/jquery/jquery.min.js"></script>

    <script src="partials/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="partials/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>
