@extends('layouts.app')

@section('content')
<div class="container cart">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="title"> Cart </div>
                        </div>
                    </div>
                </div>
                @if (empty($cart))
                    <div class="card-body">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-12 error">There are no items in your cart.</div>
                        </div> 
                    </div> 
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-sm-4">
                                <a class="btn" href="{{ route('shopping', ['page' => 1]) }}">Return to shopping</a>
                            </div>
                        </div>
                    </div>
                @else 
                    <!-- {{ Form::open(['route' => 'checkout'])}} -->
                        <div class="card-body container">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            @foreach($cart as $item)
                            <div class="row no-gutters justify-content-center align-items-center">
                                <div class="col-sm-2 image-container">
                                    <img src="{{ $item->image }}" class="fas fa-shopping-bag fa-5x">
                                </div>
                                <a href="{{ route('itemDescription', ['id' => $item->id])}}" class="col-sm-4 description">
                                    
                                    <div class="title">{{ $item->name }}</div>
                                    <p>{{ $item->short_description }}</p>
                                    
                                </a>
                                <div class="col-sm-2 amount">
                                    <input type="text" name="amount" value="{{ $item->amount }}" autocomplete="off">
                                    <button href="{{ route('removeFromCart', ['id' => $item->id ]) }}" class="btn minus remove-from-cart" value="{{ $item->id }}">-1</button><button href="{{ route('addToCart', ['id' => $item->id ]) }}" class="btn add-to-cart" value="{{ $item->id }}">+1</button>
                                </div>
                                <div class="col-sm-2 price">$<span>{{ $item->price * $item->amount }}</span></div>
                            </div>
                            @endforeach 
                        
                        </div>
                    <!-- {{ Form::close() }} -->
                    <div class="card-footer">
                        {{ Form::open(array('url' => route('checkout'))) }}
                        <div id="total" class="row justify-content-end no-gutters">
                            <div class="col-sm-8 title total">Total:</div>
                            <div class="col-sm-2 title price">$<span>{{ $total }}</span></div>
                            <button class="col-sm-2 btn" type="submit">Checkout</button>
                            
                            
                        </div>
                        {{ Form::close() }}
                    </div>

                @endif
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
                var amountObject = $(this).parent().children('input');
                var amount = parseInt(amountObject.val());
                var route = "{{ route('addToCart') }}";
                var id = $(this).val();
                var priceObject = $(this).parent().parent().children('.price').children('span');
                var price = parseInt(priceObject.text())/amount;
                var totalObject = $('#total').children('.price').children('span');
                var total = parseInt(totalObject.text());

                modifyCart(route,id);
                totalObject.text(total+price);
                priceObject.text(price*(amount+1));
                amountObject.val(amount+1);
                // console.log(totalObject);

                
            });
            $(".remove-from-cart").click(function(){
                var amountObject = $(this).parent().children('input');
                var amount = parseInt(amountObject.val());
                var route = "{{ route('removeFromCart') }}";
                var id = $(this).val();
                var priceObject = $(this).parent().parent().children('.price').children('span');
                var price = parseInt(priceObject.text())/amount;
                var totalObject = $('#total').children('.price').children('span');
                var total = parseInt(totalObject.text());

                modifyCart(route,id);
                if (amount <= 1) {
                    location.reload();
                    $(this).closest('.row').hide();
                }else{                    
                    priceObject.text(price*(amount-1));
                    amountObject.val(amount-1);
                }
                totalObject.text(total-price);
            });
        });
        
    </script>
    
@endsection