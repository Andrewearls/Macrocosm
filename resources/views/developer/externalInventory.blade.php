@extends('layouts.cards.developer')

@section('cardheader')
    <div class="row no-gutters justify-content-between">
        <div class="col-6 title">
            {{ Form::label('cms:') }}
            {{ Form::text('name', (isset($result->name)) ? $result->name : 'name') }}
        </div>
        
        
        <div class="col-5">
            {{ Form::label('link:') }}
            {{ Form::text('link', $result->link) }}                
        </div>
        
        @if (isset($deleteRoute))
            <div class="col-1 remove-all"><a href="{{ $deleteRoute }}"><div class="far fa-times-circle fa-3x btn btn-link-red"></div></a></div>
        @endif
        
    </div>
@endsection

@section('cardbody')
    <div class="row no-gutters align-results-center">
        <div class="col-4 image-container">
        	{{ (isset($result->image)) ? $result->image : Form::label('Image:') }}
            {{ Form::textArea('image') }}
        </div>
        <div class="col-8 long-description">
            <p>
            	{{ Form::label('description:') }}
            	{{ Form::textArea('description', (isset($result->description)) ? $result->description : '') }}
            </p>
        </div>
    </div>
@endsection