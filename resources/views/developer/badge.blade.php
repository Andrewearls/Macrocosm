@extends('layouts.cards.developer')

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
        <div class="col-sm-3">
            <a class="btn" href="{{ route('badgeDescription', ['id' => $result->id]) }}">Back to Description</a>
        </div>
        <div class="col-sm-3">
        	<a href="{{ route('editBadgeRequirements', ['id' => $result->id]) }}" class="btn">Add Requirements</a>
        </div>
        <div class="col-sm-3">
            {{ Form::submit('Submit', ['class' => 'btn']) }}
        </div>
    </div>
@endsection