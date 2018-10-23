@extends('developer.cms')

@section('requirementsbutton')

	<a class="btn" href="{{ route('editBadgeRequirements', ['id' => $result->id]) }}">Add Requirements</a>

@endsection