<!DOCTYPE html>
<html class="no-js css-menubar" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="animsition @yield('body_class')">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

@include('partials.site_navbar')
@include('partials.site-menu-item')
{{--@include('partials.site_gridmenu')--}}

@section('body')
    <div class="page">
        <div class="page-header">
            @yield('header')
        </div>
        <div class="page-content">
            @yield('content')
        </div>
    </div>
@show

<!-- Footer -->
@include('partials.site_footer')

@include('partials.javascripts')
</body>
</html>
