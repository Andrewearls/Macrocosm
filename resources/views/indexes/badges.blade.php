@extends('layouts.cards.index')

@section('pagespecificid')
    id="badge"
@endsection

@section('cardheader')
    <div class="row justify-content-between no-gutters">
        <div class="col-sm-5 title">
            Badges
        </div>
        <div class="col-sm-2">
            <a class="btn" href="{{ route('newBadge') }}">New Badge</a>
        </div>
    </div>
@endsection
      
