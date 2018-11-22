@extends('layouts.card')

@section('beforeCard')
    <form method="POST" action="{{ route('register') }}">
        @csrf
@endsection

@section('cardheader')
    <div class="row justify-content-between no-gutters">
        <div class="col-6 col-sm-6 title">
            {{ __('Register') }}
        </div>
    </div>
@endsection

@section('cardbody')    

    <div class="form-group row">
        <label for="name" class="col-lg-4 col-form-label text-lg-right">{{ __('Name') }}</label>

        <div class="col-lg-6">
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-lg-4 col-form-label text-lg-right">{{ __('E-Mail Address') }}</label>

        <div class="col-lg-6">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
        <label for="password-confirm" class="col-lg-4 col-form-label text-lg-right">{{ __('Confirm') }}</label>

        <div class="col-lg-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>
    
@endsection

@section('cardfooter')
    <div class="row justify-content-center no-gutters">
        <button type="submit" class="btn btn-gray">
            {{ __('Register') }}
        </button>
    </div>
@endsection

@section('afterCard')
    </form>
@endsection
