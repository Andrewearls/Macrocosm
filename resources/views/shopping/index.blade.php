@extends('layouts.card')

@section('id')
    id="shopping"
@endsection

@section('cardheader')
    <div class="row">
        <div class="col-sm-6">
            Shopping
        </div>
        <div class="col-sm-6 display-count">
            <span>{{ (($page * 12) <= $count) ? $page * 12 : $count }}</span> of {{ $count }}
        </div>
    </div>
@endsection   

@section('cardbody')  
    <div class="row no-gutters">
        @foreach ($inventory as $item)
            <a href="{{ route('itemDescription', ['id' => $item['id']]) }}" class="col-md-3 item-container">
                <img src="{{ $item['image'] }}">
                <!-- <i class="fas fa-shopping-bag fa-5x"></i> -->
                <div class="title">
                    @if(strlen($item['name']) > 8)
                        {{ substr($item['name'], 0, 8) }}...
                    @else
                        {{ $item['name'] }}
                    @endif
                </div>
                        
                <p>                                    
                    @if(strlen($item['short_description']) > 15)
                        {{ substr($item['short_description'], 0, 15) }}...
                    @else
                        {{ $item['short_description'] }}
                    @endif
                </p>
            </a>
        @endforeach
    </div>
@endsection

@section('cardfooter')    
    <div class="row">
        <div class="col-sm-3">
            <a {{ ($page-1 > 0) ? "href=".route('shopping', ['page' => $page-1]) : '' }}><i class="fas fa-arrow-circle-left fa-2x"></i></a>
        </div>
        <div class="col-sm-6 page-numbers">
            @if ($page-1 > 0)
                <a href="{{ route('shopping', [$page-1]) }}">{{ $page-1 }}</a>
            @endif
            <span>{{ $page }}</span>
            @if ($page+1 <= $pages) 
                <a href="{{ route('shopping', [$page+1]) }}">{{ $page+1 }}</a> 
            @endif
        </div>
        <div class="col-sm-3">
            <a {{ ($page+1 <= $pages) ? "href=".route('shopping', ['page' => $page+1]) : '' }}><i class="fas fa-arrow-circle-right fa-2x"></i></a>
        </div>
    </div>        
@endsection

@section('cardspecificscripts')

@endsection