@extends('layouts.card')

@section('layoutid')
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
                <input type="text" name="amount" value="{{ $item->amount }}" autocomplete="off" readonly>
                <button href="{{ route('removeFromCart', ['id' => $item->id ]) }}" class="btn minus remove-from-cart" value="{{ $item->id }}">-1</button><button href="{{ route('addToCart', ['id' => $item->id ]) }}" class="btn add-to-cart" value="{{ $item->id }}">+1</button>
            </div>
            <div class="col-sm-2 price">$<span>{{ $item->price * $item->amount }}</span></div>
            <div class="col-sm-2 remove-all"><button class="far fa-times-circle fa-3x btn red-button" value="{{ $item->id }}"></button></div>
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
                console.log('checking cart');
                console.log($(".cart-not-empty").length);
                if ($(".cart-not-empty").length <= 1) {
                    $(".cart-not-empty").hide();
                    
                    $(".cart-empty").removeClass('hidden');
                }
            }
            function itemCollection(thisObject){
                var item ={
                    "amountObject" : $(thisObject).find('.amount').children('input'),
                    "amount" : parseInt($(thisObject).find('input').val()),
                    "id" : $(thisObject).find('.remove-all').children('button').val(),
                    "priceObject" : $(thisObject).find('.price').children('span'),
                    "price" : parseInt($(thisObject).find('.price').children('span').text())/parseInt($(thisObject).find('input').val()),                    
                };
                return item;
            }
            function updateTotal(price) {
                var totalObject = $('#total').find('.price').children('span');
                var total = parseInt(totalObject.text());
                totalObject.text(total+price);
            }
            function updatePrice(item, amount) {
                item["priceObject"].text(item["price"]*(amount));
                item["amountObject"].val(amount);
            }
            checkCart();
            $(".remove-all").click(function(){
                if (confirm("Are you sure you want to remove this item?")) {
                    $(this).closest(".row").remove();

                    var item = itemCollection($(this).closest('.row'));
                    var route = "{{ route('clearItem') }}";

                    modifyCart(route, item["id"]);
                    updateTotal(-item["amount"]*item["price"]);
                    checkCart();
                }

            });
            $(".add-to-cart").click(function(){
                
                var route = "{{ route('addToCart') }}"; 
                var item = itemCollection($(this).closest('.row'));

                modifyCart(route,item["id"]);
                updateTotal(item["price"]);
                updatePrice(item, item["amount"]+1);
                              
            });
            $(".remove-from-cart").click(function(){
                
                var route = "{{ route('removeFromCart') }}";
                var item = itemCollection($(this).closest('.row'));

                if (item["amount"] <= 1) {
                    $(this).closest('.row').remove();
                }else{                    
                    updatePrice(item, item["amount"]-1);                    
                }

                modifyCart(route,item["id"]);
                updateTotal(-item["price"]);                
                checkCart();

            });
        });
        
    </script>
    
@endsection