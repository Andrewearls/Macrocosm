@extends('layouts.cards.index')

@section('pagespecificid')
    id="training"
@endsection

@section('cardheader')
    <div class="row justify-content-between no-gutters">
        <div class="col-sm-5 title">
            Training
        </div>

        <div class="col-sm-3">
            <a class="btn" href="{{ route('newClassItem') }}">New Training Class</a>
        </div>
    </div>
@endsection
      
