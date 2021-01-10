@extends('layouts.auth')
@section('title', 'Sign In')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group form-material floating" data-plugin="formMaterial">
            <input id="email" name="email" type="email"
                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   value="{{ old('email') }}" required autofocus/>

            <label class="floating-label" for="email">{{ __('Email') }}</label>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group form-material floating" data-plugin="formMaterial">
            <input id="password" name="password" type="password"
                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" />

            <label class="floating-label" for="password">{{ __('Password') }}</label>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group clearfix">
            <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">{{ __('Remember Me') }}</label>
            </div>
            <a class="float-right" href="{{ route('password.request') }}">Forgot password?</a>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">Sign in</button>
    </form>
 <p>Still no account? Please go to <a href="{{ route('register') }}">Sign up</a></p>
@endsection
