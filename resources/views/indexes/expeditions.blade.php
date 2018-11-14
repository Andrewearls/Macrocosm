@extends('layouts.cards.index')

@section('pagespecificid')
    id="expedition"
@endsection

@section('cardheader')
    <div class="row justify-content-between no-gutters">
        <div class="col-sm-5 title">
            expeditions
        </div>
        @if(Auth::user()->positions->contains('name', 'pathfinder'))
	        <div class="col-sm-3 btn-container">
	            <a class="btn" href="{{ route('newBadge') }}">New Expedition</a>
	        </div>
	    @endif
    </div>
@endsection
