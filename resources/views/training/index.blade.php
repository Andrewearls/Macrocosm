@extends('layouts.card')

@section('layoutid')
    id="training"
@endsection

@section('cardheader')
    <div class="row">
        <div class="col-sm-6">
            Training
        </div>
    </div>
@endsection
      
@section('cardbody')        
    <div class="row no-gutters">
        @foreach((array) $classes as $class)
            <a href="{{ route('classDescription', ['id' => $class['id']]) }}" class="col-sm-3 item-container">
                <div class="title">
                    @if(strlen($class['name']) > 8)
                        {{ substr($class['name'], 0, 8) }}...
                    @else
                        {{ $class['name'] }}
                    @endif
                </div>
                <i class="fas fa-flag-checkered fa-3x"></i>
                <p>
                    @if(strlen($class['short_description']) > 15)
                        {{ substr($class['short_description'], 0, 15) }}...
                    @else
                        {{ $class['short_description'] }}
                    @endif
                </p>
            </a>
        @endforeach
    </div>        
@endsection

@section('cardfooter')
    <div class="row">
        
    </div>
@endsection

@section('pagespecificscripts')

@endsection