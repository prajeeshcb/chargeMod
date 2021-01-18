@extends('layouts.blank')
@section('body_class', 'page-login-v3 layout-full')

@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/examples/css/pages/login-v3.css') }}">
@endpush

@push('js_vendor')
    @parent
    <script src="{{ asset('/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
@endpush

@push('js')
    <script src="{{ asset('/assets/js/Plugin/jquery-placeholder.js') }}"></script>
    <script src="{{ asset('/assets/js/Plugin/material.js') }}"></script>
@endpush

@section('body')
<!-- Page -->
<div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
        <div class="panel">
            <div class="panel-body">
                @section('header')
                    <div class="brand">
                        <img width="30%" class="brand-img" src="{{ asset('/assets/images/logo_yellow.png') }}" alt="...">
                        <h2 class="brand-text font-size-18">{{ config('app.name') }}</h2>
                    </div>
                @show
                @yield('content')
            </div>
        </div>

        <footer class="page-copyright page-copyright-inverse">
            <p>Developed by <a class="text-light" href="">Pixbit Solutions</a> </p>
            <p>© 2018. All Right Reserved.</p>
        </footer>
    </div>
</div>
<!-- End Page -->
@endsection
