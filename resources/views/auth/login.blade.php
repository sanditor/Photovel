@extends('layouts.app')

@section('content')
<div class="container">
    <div class="login-box">
        <img src="{{ asset('img/logo.png')  }}" class="avatar rounded-circle" alt="Avatar Image">
        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            <label for="email">{{ __('E-Mail') }}</label>
            <input id="email" type="email" placeholder="Enter E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" placeholder="Enter Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
           <!--  <div class="row">
                <div class="col-md-3">
                    <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                </div>
                <div class="col-md-6">
                    <label for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div> -->

            <button type="submit">
                {{ __('Login') }}
            </button><br><br>
            <a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        </form>
    </div>
</div>
@endsection
