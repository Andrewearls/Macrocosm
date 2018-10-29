@extends('layouts.cards.index')

@section('pagespecificid')
    id="expedition"
@endsection

@section('cardheader')
    <div class="row justify-content-between">
        <div class="col-sm-5">
            expeditions
        </div>
        <div class="col-sm-3">
            <a class="btn" href="{{ route('newBadge') }}">New Expedition</a>
        </div>
    </div>
@endsection
