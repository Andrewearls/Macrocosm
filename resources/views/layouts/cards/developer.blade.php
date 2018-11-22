@extends('layouts.cards.description')

@section('pagespecificid')
    id="developer"
@endsection

@section('beforeCard')
    {{ Form::open(['url' => route(Route::currentRouteName(), (isset($result->id)) ? ['id' => $result->id] : "") ]) }}
@endsection

@section('cardheader')
    <div class="row no-gutters justify-content-between">
        <div class="col-6 title">
            {{ Form::label('cms:') }}
            {{ Form::text('name', (isset($result->name)) ? $result->name : 'name') }}
        </div>
        
        @if(isset($result->price))
            <div class="col-4">
                {{ Form::label('$') }}
                {{ Form::text('price', $result->price) }}                
            </div>
        @endif
        @if (isset($deleteRoute))
            <div class="col-1 remove-all"><a href="{{ $deleteRoute }}"><div class="far fa-times-circle fa-3x btn btn-large btn-link-red"></div></a></div>
        @endif
        
    </div>
@endsection

@section('cardbody')
    <div class="row no-gutters align-results-center">
        <div class="col-4 image-container">
        	<img src='{{ (isset($result->image)) ? $result->image : "" }}' class="fas fa-shopping-bag fa-5x">
            {{ Form::file('image', ['onchange' => 'readURL(this)']) }}
        </div>
        <div class="col-8 long-description">
            {{ Form::label('description:') }}
            <p>
            	
            	{{ Form::textArea('description', (isset($result->description)) ? $result->description : '') }}
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

@section('afterCard')
    {{ Form::close() }}
@endsection

@section('pagespecificscripts')

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-container').children('img')
                        .attr('src', e.target.result)
                        .css('border', '2px solid lightblue');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection