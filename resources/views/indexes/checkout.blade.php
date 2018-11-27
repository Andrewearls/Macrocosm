@extends('layouts.cards.index')

@section('cardheader')
    <div class="row justify-content-between">
        <div class="col-5 title">
            Checkout
        </div>
    </div>
@endsection

@section('cardbody')        
    <div class="row no-gutters">
    	<div class="col-5">
    		<div class="title">Billing info</div>
    		<p>
	    		<span>Purchaser:</span> {{ Auth::user()->name }} <br>
	    		<span>Card Info:</span> with card #### <br>
	    		<span>Billing Address:</span> --- <br>
			</p>
    	</div>

    	<div class="col-7">
    		<div class="row no-gutters title">
    			Reciept
    		</div>
    		<p>
	    		@foreach((array) $cart as $item)
			        <div class="row no-gutters justify-content-center align-items-center cart-not-empty">
			            <div class="col-2 image-container">
			                <img src="{{ $item->image }}" class="fas fa-shopping-bag fa-2x">
			            </div>
			            <div class="col-4 description">
			                
			                <div class="title">{{ $item->name }}</div>
			                
			                
			            </div>
			            <div class="col-4 amount">
			                <span>Quantity:</span><br> {{ $item->amount }}
			            </div>
			            <div class="col-2 price">$<span>{{ $item->price * $item->amount }}</span></div>
			        </div>
			    @endforeach
			</p>
    	</div>
    </div>        
@endsection

@section('cardfooter')
	<div class="row no-gutters justify-content-end">
		<div class="title col-2">Total: ${{ $cartTotal }}</div>
		<button class="btn col-3">Complete Purchase</button>
	</div>
@endsection
