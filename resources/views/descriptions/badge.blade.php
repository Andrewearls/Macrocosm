@extends('layouts.cards.description')

@section('pagespecificid')
    id="badge"
@endsection

@section('cardbody')
    <div class="row no-gutters">
        <div class="col-12 col-sm-4 image-container">
        	<img src="{{ $result->image }}" class="fas fa-shield-alt fa-5x">
        </div>
        <div class="col-12 col-sm-8 long-description">
        	
        	<p><span>Description:</span> {{ $result->description }}</p>
        	<p><span>Requirements:</span> 
            	@if(!empty($result->requirements->toarray()))
            		@foreach($result->requirements as $requirement)
            			<a href="{{ $requirement->specific->descriptionRoute() }}" class="{{ (Auth::user()->requirements->contains('id', $requirement->id)) ? '' : 'btn-link-red' }}">{{ $requirement->name.', ' }}</a>
            		@endforeach
            	@else
            		None
            	@endif
            </p>

            
        </div>
    </div>
@endsection 

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
	    <a href="{{ route('badges') }}" class="col-5 col-sm-3 btn">Back to Badges</a>
	    @if(Auth::user()->meetsRequirements($result->requirements) && !Auth::user()->badges->contains('id', $result->id))
	    	<a href="{{ route('claimBadge', ['id' => $result->id]) }}" class="col-3 btn">Claim</a>
    	@endif
	    @if(Auth::user()->positions->contains('name', 'badgemaster'))
	        <a href="{{ route('editBadge', ['id' => $result->id]) }}" class="col-3 btn">Edit</a>
	    @endif
	</div>
@endsection