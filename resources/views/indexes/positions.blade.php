@extends('layouts.card')

@section('pagespecificid')
	id='positions'
@endsection

@section('cardheader')
	<div class="row justify-content-between">
		<div class="col-sm-3 title">
			Positions
		</div>
        @if(Auth::user()->positions->contains('name', 'developer'))
			<div class="col-sm-3 btn-container">
				<a class="btn" href="{{ route('newPosition') }}">Create Position</a>
			</div>
		@endif
	</div>
@endsection

@section('cardbody')

	@foreach($results as $result)
		<div class="row no-gutters">
			<div class="col-sm-3">
				{{ $result->name }}
			</div>
			<div class="col-sm-3">
				<a class="btn" href="{{ route('assignPosition', ['id' => $result->id]) }}">Assign</a>
			</div>
			<div class="col-sm-3">
				<a class="btn" href="{{ route('editPosition', ['id' => $result->id]) }}">Edit</a>
			</div>
			<div class="col-sm-3">
				<a href="{{ route('deletePosition', ['id' => $result->id]) }}">Delete</a>
			</div>
		</div>
	@endforeach

@endsection