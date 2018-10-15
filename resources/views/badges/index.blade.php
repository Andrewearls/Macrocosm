@extends('layouts.card')

@section('layoutid')
    id="badges"
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
        @foreach((array) $badges as $badge)
            <a href="{{ route('badgeDescription', ['id' => $badge['id']]) }}" class="col-sm-3 item-container">
                <div class="title">
                    @if(strlen($badge['name']) > 8)
                        {{ substr($badge['name'], 0, 8) }}...
                    @else
                        {{ $badge['name'] }}
                    @endif
                </div>
                <i class="fas fa-shield-alt fa-4x"></i>
                <p>
                    @if(strlen($badge['description']) > 15)
                        {{ substr($badge['description'], 0, 15) }}...
                    @else
                        {{ $badge['description'] }}
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