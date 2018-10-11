@extends('layouts.cards.description')

@section('pagespecificid')
    id="class"
@endsection

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
        <a href="{{ url()->previous() }}" class="col-sm-3 btn">Back to Training</a>
        <a href="{{ route('editClassItem', ['id' => $item->id]) }}" class="col-sm-3 btn">Edit</a>    
    </div>
@endsection