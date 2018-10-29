@extends('layouts.cards.developer')

@section('requirementsbutton')

	<a class="btn" href="{{ route('editClassRequirements', ['id' => $result->id]) }}">Add Requirements</a>

@endsection