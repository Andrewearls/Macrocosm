@extends('layouts.cards.index')

@section('pagespecificid')
    id="shopping"
@endsection

@section('cardheader')
    <div class="row justify-content-between no-gutters">
        <div class="col-7 title">
            Shopping
        </div>
    </div>
@endsection   

@section('cardbody')   
    <div class="container-fluid no-gutters results-container lightblue-results">
        <div class="row justify-content-between no-gutters title">
            <div class="col-9 col-sm-6">
                External Items 
                <div class="far fa-question-circle infotip">
                    <span class="infotip-text">
                        Items from this section will redirect you to a third party site where they may be purchased.
                    </span>
                </div>
            </div>
            @if(Auth::user()->positions->contains('name', 'developer'))
                <div class="col-3 btn-container">
                    <a class="btn" href="{{ route('newExternalInventoryItem') }}">New Item</a>
                </div>
            @endif
        </div>     
        <div class="row no-gutters item-display">
            @foreach((array) $externalResults as $result)
                <div class="col-3 item-container">
                    <?php echo(html_entity_decode($result['image'])) ?>
                </div>
            @endforeach
        </div>    
    </div> 
    <div class="container-fluid no-gutters results-container lightgreen-results">
        <div class="row no-gutters justify-content-between title">
            <div class="col-9 col-sm-6">
                Internal Items 
                <div class="far fa-question-circle infotip">
                    <span class="infotip-text">
                        Items from this section are offered through the Macrocosm. <br>(Can be purchased through us)
                    </span>
                </div>
            </div>
            
            @if(Auth::user()->positions->contains('name', 'developer'))
                <div class="col-3 btn-container">
                    <a class="btn" href="{{ route('newInternalShoppingItem') }}">New Item</a>
                </div>
            @endif
            
        </div>     
        <div class="row no-gutters item-display">
            @foreach((array) $results as $result)
                <a href="{{ route( $routeName, ['id' => $result['id']]) }}" class="col-3 item-container">
                    <div class="title">
                        @if(strlen($result['name']) > 8)
                            {{ substr($result['name'], 0, 8) }}...
                        @else
                            {{ $result['name'] }}
                        @endif
                    </div>
                    <i class="fas fa-shield-alt fa-4x"></i>
                    <p>
                        @if(strlen($result['description']) > 15)
                            {{ substr($result['description'], 0, 15) }}...
                        @else
                            {{ $result['description'] }}
                        @endif
                    </p>
                </a>
            @endforeach
        </div>    
    </div>   
@endsection

@section('pagespecificscripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.fa-question-circle').hover(function() {
                $(this).toggleClass('far fas');
            });
        });
        
    </script>
@endsection