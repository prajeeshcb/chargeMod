@extends('layouts.blank')
@section('body_class', 'page-login-v3 layout-full')

@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/examples/css/pages/forgot-password.css') }}">
@endpush

@section('body')
<!-- Page -->
<div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
        @yield('content')

        <footer class="page-copyright page-copyright-inverse">
            <p>Developed by <a class="text-light" href="">Pixbit Solutions</a> </p>
            <p>© 2018. All Right Reserved.</p>
        </footer>
    </div>
</div>
<!-- End Page -->
@endsection
