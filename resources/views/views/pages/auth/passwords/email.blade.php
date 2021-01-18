@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('header')
    <h2>Forgot Your Password?</h2>
    <p>Input your registered email to reset your password</p>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group form-material floating" data-plugin="formMaterial">
            <input id="email" name="email" type="email"
                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   value="{{ old('email') }}" required autofocus/>

            <label class="floating-label">{{ __('Email') }}</label>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">{{ __('Send Password Reset Link') }}</button>
    </form>
@endsection
