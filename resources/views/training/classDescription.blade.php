@extends('layouts.card')

@section('id')
    id="class"
@endsection

@section('cardheader')
    <div class="row">
        <div class="col-sm-6">
            <div> {{ $class->name }} </div>
        </div>
        
    </div>
@endsection

@section('cardbody')
    <div class="row no-gutters">
        <div class="col-sm-4 image-container">
        	<img src="{{ $class->image }}" class="fas fa-shopping-bag fa-5x">
        </div>
        <div class="col-sm-8 long-description">
        	
        	<!-- <div class="title">Description:</div> -->
        	<p>{{ $class->description }}</p>
            
        	<!-- <p>{{ $class->short_description }}</p> -->
        </div>
    </div>
@endsection 

@section('cardfooter')
    <!-- {{ Form::open(array('url' => route('addToCart'))) }} -->
    <div class="row justify-content-between no-gutters">
        <a href="{{ url()->previous() }}" class="col-sm-3 btn">Back To Training</a>
              
    </div>
    <!-- {{ Form::close() }} -->
@endsection

@section('pagespecificscripts')
    <script src="{{ asset('js/ajax/modifyCart.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".add-to-cart").click(function(){

                var route = "{{ route('addToCart') }}";
                var id = $(this).val();

                modifyCart(route, id);

                $('.added').show('slow', function(){
                    $('.fa-shopping-bag').css('color', 'lightgreen');
                });
                $('.added').fadeOut('slow', function(){
                    $('.fa-shopping-bag').css('color', '');
                });
                               
            });
        });
    </script>
@endsection