<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! $title?? lang()=='ar'?setting()->site_name_ar:setting()->site_name_en !!}</title>

    <link rel="icon" href="{!! Storage::url(setting()->icon) !!}" type="image/x-icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('/design/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{!! asset('/design/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('/design/dist/css/adminlte.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('/design/dist/css/login.style.css') !!}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">

<nav class="main-header navbar navbar-expand navbar-gold navbar-light">
    <!-- Left navbar links -->
    <div class="navbar-nav navbar-brand text-gold">
        {{ config('app.name', 'Wall Of Fame') }}
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link text-gold" href="#">
                Login
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
