<head>
    <title>@yield('title', 'Admin Page')</title>

    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    {{-- CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/animate.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/animation.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/bootstrap-select.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/font/fonts.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/icon/style.css') }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">

    <link rel="apple-touch-icon-precomposed" href="{{ asset('admin/assets/images/favicon.ico') }}">

    {{-- Plugins --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/sweetalert.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/custom.css') }}">

    {{-- Page Specific CSS --}}
    @yield('css')
</head>
