@extends('layouts.app')

@section('content')
<div class="container item">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="title"> {{ $item->name }} </div>
                        </div>
                        <div class="col-sm-6 price">
                            ${{ $item->price }}
                        </div>
                    </div>
                </div>

                <div class="card-body container">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row no-gutters">
                        <div class="col-sm-4 image-container">
                        	<img src="{{ $item->image }}" class="fas fa-shopping-bag fa-5x">
                        </div>
                        <div class="col-sm-8 long-description">
                        	
	                    	<!-- <div class="title">Description:</div> -->
	                    	<p>{{ $item->description }}</p>
		                    
                        	<!-- <p>{{ $item->short_description }}</p> -->
                        </div>
                    </div>
                    
                    
                                     

                </div>
                <div class="card-footer">
                    <!-- {{ Form::open(array('url' => route('addToCart'))) }} -->
                    <div class="row justify-content-between no-gutters">
                        <a href="{{ url()->previous() }}" class="col-sm-3 add-to-cart btn">Back To Shopping</a>
                        <button class="col-sm-2 add-to-cart btn" name="item" value="{{ $item->id }}">Add To Cart</button>
                        
                        
                    </div>
                    <!-- {{ Form::close() }} -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('pagespecificscripts')
    <script src="{{ asset('js/ajax/modifyCart.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".add-to-cart").click(function(){
                console.log('here');
                var route = "{{ route('addToCart') }}";
                var id = $(this).val();

                modifyCart(route, id);

            });
        });
    </script>
@endsection