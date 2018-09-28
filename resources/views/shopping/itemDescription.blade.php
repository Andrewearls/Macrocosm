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
                    {{ Form::open(array('url' => route('addToCart'))) }}
                    <div class="row justify-content-end no-gutters">
                        
                        <button class="col-sm-2 add-to-cart btn" type="submit" name="item" value="{{ $item->id }}">Add To Cart</button>
                        
                        
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
