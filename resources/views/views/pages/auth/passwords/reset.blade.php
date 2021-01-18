@extends('layouts.auth')
@section('title', 'Reset Password')

@section('header')
    <h2>Reset Password</h2>
    <p>Input your registered email and new password to reset</p>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group form-material floating" data-plugin="formMaterial">
            <input id="email" name="email" type="email"
                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   value="{{ $email ?? old('email') }}" required autofocus/>

            <label class="floating-label">{{ __('Email') }}</label>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group form-material floating" data-plugin="formMaterial">
            <input id="password" name="password" type="password"
                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required />

            <label class="floating-label" for="password">Password</label>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('name') }}</span>
            @endif

        </div>
        <div class="form-group form-material floating" data-plugin="formMaterial">
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required />

            <label class="floating-label" for="password_confirmation">Re-enter Password</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">{{ __('Reset Password') }}</button>
    </form>
@endsection
