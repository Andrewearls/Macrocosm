@extends('layouts.cards.description')

@section('pagespecificid')
    id="class"
@endsection

@section('cardfooter')
    <div class="row justify-content-between no-gutters">

	    <a href="{{ route('training') }}" class="col-sm-3 btn">Back to Training</a>
	    @if(Auth::user()->positions->contains('name', 'explorer'))
	    	@if(Auth::user()->enroll->contains('id', $result->id))
		    	<a href="{{ route('unenroll', ['id' => $result->id]) }}" class="col-sm-3 btn btn-red">Unenroll</a>
	    	@else
		    	<a href="{{ route('enroll', ['id' => $result->id]) }}" class="col-sm-3 btn">Enroll</a>
	    	@endif
	    @endif
	    @if(Auth::user()->positions->contains('name', 'instructor'))
	    	<a href="{{ route('enrolled', ['id' => $result->id]) }}" class="col-sm-3 btn">Enrolled</a> 
	        <a href="{{ route('editClassItem', ['id' => $result->id]) }}" class="col-sm-3 btn">Edit</a>    
	    @endif
	</div>
@endsection