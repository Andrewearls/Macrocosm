@extends('layouts.cards.index')

@section('pagespecificid')
    id="badge"
@endsection

@section('cardheader')
    <div class="row justify-content-between no-gutters">
        <div class="col-5 col-6 title">
            Badges
        </div>
        @if(Auth::user()->positions->contains('name', 'badgemaster'))
	        <div class="col-4 btn-container">
	            <a class="btn" href="{{ route('newBadge') }}">New Badge</a>
	        </div>
	    @endif
    </div>
@endsection
      
