@extends('layouts.cards.index')

@section('pagespecificid')
    id="shopping"
@endsection

@section('cardheader')
    <div class="row">
        <div class="col-sm-3">
            Shopping
        </div>
    
        <div class="col-sm-2">
            <a class="btn" href="{{ route('newShoppingItem') }}">New Item</a>
        </div>
        
        <div class="col-sm-7 display-count">
            <span>{{ (($page * 12) <= $count) ? $page * 12 : $count }}</span> of {{ $count }}
        </div>
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