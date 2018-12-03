@extends('layouts.cards.developer')

@section('cardbody')
	<div class="row no-gutters align-results-center">
        <div class="col-4 image-container">
        	<img src='{{ (isset($result->image)) ? $result->image : "" }}' class="fas fa-shopping-bag fa-5x">
            {{ Form::file('image', ['onchange' => 'readURL(this)']) }}
        </div>
        <div class="col-8 long-description">
        	<div class="row no-gutters tab-container">
            	<div class="col-4 tab active" onclick="makevisible('.description')">{{ Form::label('description') }}</div>
            	<div class="col-4 tab not-active" onclick="makevisible('.when')">{{ Form::label('when') }}</div>
            	<div class="col-4 tab not-active" onclick="makevisible('.where')">{{ Form::label('where') }}</div>
            </div>
            <p class="description visible">
            	{{ Form::textArea('description', (isset($result->description)) ? $result->description : '') }}
            </p>
            <div class="when hidden">
            	{{ Form::label('time:') }}
            	<input type="time" name="time" id="time"><br>

            	{{ Form::label('date:') }}
            	{{ Form::date('date', (isset($result->date)) ? $result->date : '')}} <br>
                {{ Form::label('frequency:') }}
                {{ Form::hidden('frequency', (isset($result->frequency)) ? $result->frequency : '1', ['id'=>'frequency']) }}
                <button type="button" id="frequencyDropdown" class="btn">Select</button>
                <ul id="frequencyList" class="hidden">
                    <li value="1" class="frequencyOption">Daily</li>
                    <li value="7" class="frequencyOption">Weekly</li>
                    <!-- <li class="frequencyOption">Monthly</li> -->
                </ul>
            </div>
            <p class="where hidden">
            	{{ Form::label('location:') }}
            	{{ Form::text('location', (isset($result->location)) ? $result->location : '')}}
            </p>
        </div>
    </div>
@endsection

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
        <div class="col-1">
            <a class="btn" href="{{ url()->previous() }}">Back</a>
        </div>
	    
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
		 	

            $('#time').val('{!! $result->time !!}');

		 	$(document).on('click', ".not-active", function(){
		 		$('.active').toggleClass('active not-active');
		 		$(this).toggleClass('active not-active');
		 	});            

            $(".frequencyOption").click(function(){
                $('#frequencyDropdown').text($(this).text());
                $('#frequency').val($(this).val());
                $("#frequencyList").toggleClass('hidden not-hidden');
            });

            $("#frequencyDropdown").on('click', function(){
                $("#frequencyList").toggleClass('hidden not-hidden');
            });

            

		});
	</script>
@endsection