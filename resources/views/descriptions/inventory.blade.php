@extends('layouts.cards.description')

@section('pagespecificid')
    id="inventory"
@endsection

@section('cardheader')
    <div class="row">
        <div class="col-sm-6">
            <div> {{ $result->name }} </div>
        </div>
        <div class="col-sm-6 price">
            ${{ $result->price }}
        </div>
    </div>
@endsection 

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
        <a href="{{ route('shopping', ['page' => 1]) }}" class="col-sm-3 btn">Back To Shopping</a>
        @if(Auth::user()->positions->contains('name', 'developer'))
            <a href="{{ route('editShoppingItem', ['id' => $result->id]) }}" class="col-sm-3 btn">edit</a>
        @endif
        <button class="col-sm-2 add-to-cart btn" name="item" value="{{ $result->id }}">Add To Cart</button>      
    </div>
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