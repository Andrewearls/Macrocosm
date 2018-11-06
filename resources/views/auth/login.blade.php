@extends('layouts.card')

@section('layoutid')
    id='auth'
@endsection

@section('pagespecificid')
    id='login'
@endsection

@section('beforeCard')
    <form method="POST" action="{{ route('login') }}">
    @csrf
@endsection

@section('cardheader')
    <div class="row justify-content-between no-gutters">
        <div class="col-sm-3 title">
            {{ __('Login') }}
        </div>
    </div>
@endsection

@section('cardbody')    

    <div class="form-group row">
        <label for="email" class="col-lg-4 col-form-label text-lg-right">{{ __('E-Mail Address') }}</label>

        <div class="col-lg-6">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-lg-4 col-form-label text-lg-right">{{ __('Password') }}</label>

        <div class="col-lg-6">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6 offset-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
    </div>
    
@endsection

@section('cardfooter')
    <div class="row justify-content-center no-gutters">
        <button type="submit" class="btn btn-gray">
            {{ __('Login') }}
        </button>

        <a class="forgot-password" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    </div>
@endsection

@section('afterCard')
    </form>
@endsection