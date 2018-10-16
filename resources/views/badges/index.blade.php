@extends('layouts.card')

@section('layoutid')
    id="results"
@endsection

@section('cardheader')
    <div class="row justify-content-between">
        <div class="col-sm-5">
            Badges
        </div>
        <div class="col-sm-3">
            <a class="btn" href="{{ route('newBadge') }}">New Badge</a>
        </div>
    </div>
@endsection
      
@section('cardbody')        
    <div class="row no-gutters">
        @foreach((array) $results as $result)
            <a href="{{ route('badgeDescription', ['id' => $result['id']]) }}" class="col-sm-3 item-container">
                <div class="title">
                    @if(strlen($result['name']) > 8)
                        {{ substr($result['name'], 0, 8) }}...
                    @else
                        {{ $result['name'] }}
                    @endif
                </div>
                <i class="fas fa-shield-alt fa-4x"></i>
                <p>
                    @if(strlen($result['description']) > 15)
                        {{ substr($result['description'], 0, 15) }}...
                    @else
                        {{ $result['description'] }}
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