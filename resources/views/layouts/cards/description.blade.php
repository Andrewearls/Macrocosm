@extends('layouts.card')

@section('layoutid')
    id="description"
@endsection

@section('cardheader')
        <div class="col-6 title">
            <div> {{ $result->requirement->name }} </div>
        </div>        
@endsection

@section('cardbody')
    <div class="row no-gutters">
        <div class="col-4 image-container">
        	<span class="helper"></span><img src="{{ $result->image }}" class="fas fa-shopping-bag fa-5x">
        </div>
        <div class="col-8 long-description">
        	
        	<p><span>Description:</span> {{ $result->description }}</p>
            
        </div>
    </div>
@endsection 

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
        <a href="{{ url()->previous() }}" class="col-3 btn">@yield('backbutton','Back')</a>
    </div>
@endsection

@section('pagespecificscripts')
    
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            
        });
    </script> -->

@endsection