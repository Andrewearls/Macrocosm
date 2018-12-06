@extends('layouts.card')

@section('layoutid')
	id="auth"
@endsection

@section('pagespecificid')
	id="verify"
@endsection

@section('cardheader')
<div class="row no-gutters">
	<div class="col-12 title">
	    {{ __('Verify Your Email Address') }}
	</div>
</div>
@endsection

@section('cardbody')
	<div class="row no-gutters justify-content-center">
		<div class="col-10">
		    @if (session('resent'))
		        <div class="alert alert-success" role="alert">
		            {{ __('A fresh verification link has been sent to your email address.') }}
		        </div>
		    @endif
		    <p>

			    {{ __('Before proceeding, please check your email for a verification link.') }}
			    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here') }}</a> to request another.
			</p>
		</div>
	</div>
@endsection
