@extends('layouts.card')

@section('layoutid')
    id="index"
@endsection

@section('cardheader')
    <div class="row justify-content-between">
        <div class="col-5 title">
            Index
        </div>
    </div>
@endsection
      
@section('cardbody')        
    <div class="row no-gutters">
        @foreach((array) $results as $result)
            <a href="{{ route( $routeName, ['id' => $result['id']]) }}" class="col-6 col-sm-3 item-container {{ $result['class'] }}">
                
                <i class="fas fa-shield-alt fa-4x"></i>
                <div class="title">
                    @if(strlen($result['name']) > 12)
                        {{ substr($result['name'], 0, 12) }}...
                    @else
                        {{ $result['name'] }}
                    @endif
                </div>
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