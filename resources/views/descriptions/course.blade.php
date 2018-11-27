@extends('layouts.cards.description')

@section('pagespecificid')
    id="class"
@endsection

@section('cardbody')
    <div class="row no-gutters">
        <div class="col-12 col-sm-4 image-container">
            <img src="{{ $result->image }}" class="fas fa-shopping-bag fa-5x">
        </div>
        <div class="col-12 col-sm-8 long-description">
            
            <p><span>Description:</span> {{ $result->description }}</p>
            <p><span>Location:</span> {{ $result->location }}</p>
            <p><span>When:</span> {{ date('g:i a', strtotime($result->time)).' on '.date('l m/d/Y', strtotime($result->date)) }}</p>
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

	    <a href="{{ route('training') }}" class="col-5 col-sm-3 btn">Back to Training</a>
	    @if(!Auth::user()->requirements->contains('id', $result->requirement->id) && Auth::user()->meetsRequirements($result->requirements))
	    	@if(Auth::user()->enroll->contains('id', $result->id))
		    	<a href="{{ route('unenroll', ['id' => $result->id]) }}" class="col-3 btn btn-red">Unenroll</a>
	    	@else
		    	<a href="{{ route('enroll', ['id' => $result->id]) }}" class="col-3 btn">Enroll</a>
	    	@endif
	    @endif
	    @if(Auth::user()->positions->contains('name', 'instructor'))
	    	<a href="{{ route('enrolled', ['id' => $result->id]) }}" class="col-3 btn">Enrolled</a> 
	        <a href="{{ route('editClassItem', ['id' => $result->id]) }}" class="col-3 btn">Edit</a>    
	    @endif
	</div>
@endsection