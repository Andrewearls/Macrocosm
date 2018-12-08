@extends('layouts.cards.index')

@section('pagespecificid')
    id="training"
@endsection

@section('cardheader')
    <div class="row justify-content-between no-gutters">
        <div class="col-6 col-sm-5 title">
            Training
        </div>
        @if(Auth::user()->positions->contains('name', 'Instructor'))
	        <div class="col-4 col-sm-3 btn-container">
	            <a class="btn" href="{{ route('newClassItem') }}">New Class</a>
	        </div>
	    @endif
    </div>
@endsection

@section('cardbody')        
    <div class="row no-gutters">
        @foreach((array) $results as $result)
            <a href="{{ route( $routeName, ['id' => $result['id']]) }}" class="col-6 col-sm-3 item-container {{ $result['class'] }}">
                
                <i class="fas fa-bullseye fa-5x"></i>
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


