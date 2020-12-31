@extends('layouts.auth')
@section('title', 'Sign Up')

@section('content')
    <form method="post" action="#">
        @csrf

        <div class="form-group form-material floating" data-plugin="formMaterial">
            <input id="name" name="name"type="text"
                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                   value="{{ old('name') }}" required autofocus />

            <label class="floating-label" for="name">Full Name</label>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group form-material floating" data-plugin="formMaterial">
            <input id="email" name="email"type="email"
                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   value="{{ old('email') }}" required />

            <label class="floating-label" for="email">Email</label>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('name') }}</span>
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

        <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">Sign up</button>
    </form>
    <p>Have account already? Please go to <a href="{{ route('login') }}">Sign In</a></p>
@endsection

