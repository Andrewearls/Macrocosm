@extends('developer.cms')

@section('cardheader')
	<div class="row no-gutters justify-content-between">
        <div class="col-sm-6 title">
            Positions CMS
        </div>
        
        @if (isset($deleteRoute))
            <div class="col-sm-1 remove-all"><a href="{{ $deleteRoute }}"><div class="far fa-times-circle fa-3x btn red-button"></div></a></div>
        @endif
        
    </div>
@endsection

@section('cardbody')
    <div class="row no-gutters align-results-center">
    	<div class="col-sm-8" >
	        {{ Form::label('Name:') }}
	        {{ Form::text('name', (isset($result->name)) ? $result->name : 'a new position') }}
	    </div>
    </div>
@endsection 