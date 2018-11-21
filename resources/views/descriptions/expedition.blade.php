@extends('layouts.cards.description')

@section('pagespecificid')
    id="expedition"
@endsection

@section('cardbody')
    <div class="row no-gutters">
        <div class="col-sm-4 image-container">
        	<img src="{{ $result->image }}" class="fas fa-flag fa-5x">
        </div>
        <div class="col-sm-8 long-description">
        	
        	<p>Description: {{ $result->description }}</p>
            
        </div>
    </div>
@endsection 

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
	    <a href="{{ route('expeditions') }}" class="col-sm-3 btn">Back to Expeditions</a>
	    @if(Auth::user()->positions->contains('name', 'pathfinder'))
	        <a href="{{ route('editExpedition', ['id' => $result->id]) }}" class="col-sm-3 btn">Edit</a>
	    @endif    
	</div>
@endsection