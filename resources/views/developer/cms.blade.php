@extends('layouts.card')

@section('id')
    id="cms"
@endsection

@section('beforeCard')
    {{ Form::open(['route' => 'cms'])  }}
@endsection

@section('cardheader')
    <div class="row">
        <div class="col-sm-6">
            {{ Form::label('cms:') }}
            {{ Form::text('name', 'name') }}
        </div>
        <div class="col-sm-6">
            {{ Form::select('type', ['item' => 'Item', 'class' => 'Class']) }}
        </div>
    </div>
@endsection

@section('cardbody')
    <div class="row no-gutters">
        <div class="col-sm-4 image-container">
        	<img src="" class="fas fa-shopping-bag fa-5x">
            {{ Form::file('image') }}
        </div>
        <div class="col-sm-8 long-description">
        	{{ Form::label('description:') }}
        	{{ Form::textArea('description') }}
            
        </div>
    </div>
@endsection 

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
        <div></div>
        <div>
            {{ Form::submit('Submit') }}
        </div>
    </div>
@endsection

@section('afterCard')
    {{ Form::close() }}
@endsection

@section('pagespecificscripts')

    <script type="text/javascript">

    </script>
@endsection