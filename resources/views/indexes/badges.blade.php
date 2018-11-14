@extends('layouts.cards.index')

@section('pagespecificid')
    id="badge"
@endsection

@section('cardheader')
    <div class="row justify-content-between no-gutters">
        <div class="col-sm-5 title">
            Badges
        </div>
        @if(Auth::user()->positions->contains('name', 'badgemaster'))
	        <div class="col-sm-2 btn-container">
	            <a class="btn" href="{{ route('newBadge') }}">New Badge</a>
	        </div>
	    @endif
    </div>
@endsection
      
