@extends('layouts.cards.description')

@section('pagespecificid')
    id="badge"
@endsection

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
	    <a href="{{ route('badges') }}" class="col-sm-3 btn">Back to Badges</a>
	    @if(Auth::user()->positions->contains('name', 'badgemaster'))
	        <a href="{{ route('editBadge', ['id' => $result->id]) }}" class="col-sm-3 btn">Edit</a>
	    @endif
	</div>
@endsection