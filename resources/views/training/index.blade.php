@extends('layouts.card')

@section('layoutid')
    id="training"
@endsection

@section('cardheader')
    <div class="row justify-content-between">
        <div class="col-sm-5">
            Training
        </div>

        @if(Auth::user()->positions->contains('name', 'developer'))
            <div class="col-sm-3">
                <a class="btn" href="{{ route('newClassItem') }}">New Training Class</a>
            </div>
        @endif
    </div>
@endsection
      
@section('cardbody')        
    <div class="row no-gutters">
        @foreach((array) $results as $result)
            <a href="{{ route('classDescription', ['id' => $result['id']]) }}" class="col-sm-3 item-container">
                <div class="title">
                    @if(strlen($result['name']) > 8)
                        {{ substr($result['name'], 0, 8) }}...
                    @else
                        {{ $result['name'] }}
                    @endif
                </div>
                <i class="fas fa-flag-checkered fa-3x"></i>
                <p>
                    @if(strlen($result['short_description']) > 15)
                        {{ substr($result['short_description'], 0, 15) }}...
                    @else
                        {{ $result['short_description'] }}
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