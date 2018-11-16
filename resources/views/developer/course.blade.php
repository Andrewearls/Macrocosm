@extends('layouts.cards.developer')

@section('cardbody')
	<div class="row no-gutters align-results-center">
        <div class="col-sm-4 image-container">
        	<img src='{{ (isset($result->image)) ? $result->image : "" }}' class="fas fa-shopping-bag fa-5x">
            {{ Form::file('image', ['onchange' => 'readURL(this)']) }}
        </div>
        <div class="col-sm-8 long-description">
        	<div class="row no-gutters tab-container">
            	<div class="col-sm-4 tab active" onclick="makevisible('.description')">{{ Form::label('description') }}</div>
            	<div class="col-sm-4 tab not-active" onclick="makevisible('.when')">{{ Form::label('when') }}</div>
            	<div class="col-sm-4 tab not-active" onclick="makevisible('.where')">{{ Form::label('where') }}</div>
            </div>
            <p class="description visible">
            	{{ Form::textArea('description', (isset($result->description)) ? $result->description : '') }}
            </p>
            <p class="when hidden">
            	{{ Form::label('time:') }}
            	<input type="time" name="time">

            	{{ Form::label('date:') }}
            	{{ Form::date('date', (isset($result->date)) ? $result->date : '')}}            	
            </p>
            <p class="where hidden">
            	{{ Form::label('location:') }}
            	{{ Form::text('location', (isset($result->location)) ? $result->location : '')}}
            </p>
        </div>
    </div>
@endsection

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
        <div class="col-sm-1">
            <a class="btn" href="{{ url()->previous() }}">Back</a>
        </div>
	    @if(Auth::user()->positions->contains('name', 'instructor'))
	        <div class="col-sm-3">
	        	<a class="btn" href="{{ route('editClassRequirements', ['id' => $result->id]) }}">Add Requirements</a>
	        </div>
	    @endif
        <div>
            {{ Form::submit('Submit', ['class' => 'btn']) }}
        </div>
    </div>
@endsection

@section('pagespecificscripts')
	<script type="text/javascript">
		function makevisible(className) {
	 		$('.visible').toggleClass('visible hidden');
	 		$(className).toggleClass('visible hidden');
	 	}

		$(document).ready(function(){
		 	
		 	$(document).on('click', ".not-active", function(){
		 		$('.active').toggleClass('active not-active');
		 		$(this).toggleClass('active not-active');
		 	});

		});
	</script>
@endsection