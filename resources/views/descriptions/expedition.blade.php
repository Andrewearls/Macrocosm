@extends('layouts.cards.description')

@section('pagespecificid')
    id="expedition"
@endsection

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
        <a href="{{ route('expeditions') }}" class="col-sm-3 btn">Back to Expeditions</a>
        <a href="{{ route('editExpedition', ['id' => $result->id]) }}" class="col-sm-3 btn">Edit</a>    
    </div>
@endsection