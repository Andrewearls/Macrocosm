@extends('layouts.card')

@section('id')
    id="cart"
@endsection

@section('cardheader')
                    <div class="row">
                        <div class="col-sm-6">
                            <div> Cart </div>
                        </div>
                    </div>
@endsection

@section('cardbody') 
    
    <div class="row justify-content-center align-items-center cart-empty hidden">
        <div class="col-sm-12 error">There are no items in your cart.</div>
    </div> 
    @foreach((array) $cart as $item)
    <div class="row no-gutters justify-content-center align-items-center cart-not-empty">
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
        <div class="col-sm-2 remove-all"><button class="far fa-times-circle fa-3x btn red-button"></button></div>
    </div>
    @endforeach     
 
@endsection

@section('cardfooter')
    
    <div class="row no-gutters justify-content-start">
        <div class="col-sm-5">
            
            <a class="btn float-left" href="{{ route('shopping', ['page' => 1]) }}">Return to shopping</a>
            
        </div>
    
        
            <div id="total" class="col-sm-7 cart-not-empty">
                {{ Form::open(array('url' => route('checkout'))) }}
                <div class="row no-gutters">
                    <div class="col-sm-3 title total">Total:</div>
                    <div class="col-sm-4 title price">$<span>{{ $total }}</span></div>
                    <button class="col-sm-5 btn" type="submit">Checkout</button>
                </div>
                {{ Form::close() }}
            </div>
        

@endsection

@section('pagespecificscripts')
    <script src="{{ asset('js/ajax/modifyCart.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            function checkCart() {
                if ($(".cart-not-empty").length <= 1) {
                    $(".cart-not-empty").hide();
                    $(".cart-empty").removeClass('hidden');
                }
            }
            checkCart();
            $(".add-to-cart").click(function(){
                var amountObject = $(this).parent().children('input');
                var amount = parseInt(amountObject.val());
                var route = "{{ route('addToCart') }}";
                var id = $(this).val();
                var priceObject = $(this).parent().parent().children('.price').children('span');
                var price = parseInt(priceObject.text())/amount;
                var totalObject = $('#total').find('.price').children('span');
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
                console.log(amount);
                var route = "{{ route('removeFromCart') }}";
                var id = $(this).val();
                var priceObject = $(this).parent().parent().children('.price').children('span');
                var price = parseInt(priceObject.text())/amount;
                console.log(price);
                var totalObject = $('#total').find('.price').children('span');
                var total = parseInt(totalObject.text());
                console.log(total);

                modifyCart(route,id);
                if (amount <= 1) {
                    location.reload();
                    $(this).closest('.row').remove();
                }else{                    
                    priceObject.text(price*(amount-1));
                    amountObject.val(amount-1);
                }
                totalObject.text(total-price);
                checkCart;
            });
        });
        
    </script>
    
@endsection