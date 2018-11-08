@extends('layouts.cards.index')

@section('pagespecificid')
    id="training"
@endsection

@section('cardheader')
    <div class="row justify-content-between no-gutters">
        <div class="col-sm-5 title">
            Training
        </div>
        @if(Auth::user()->positions->contains('name', 'developer'))
	        <div class="col-sm-3 btn-container">
	            <a class="btn" href="{{ route('newClassItem') }}">New Training Class</a>
	        </div>
	    @endif
    </div>
@endsection
      
