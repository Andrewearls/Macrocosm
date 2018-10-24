@extends('layouts.card')

@section('layoutid')
    id="activationForm"
@endsection

@section('cardheader')
    <div class="row justify-content-between">
        <div class="col-sm-5">
            List of Users
        </div>        
    </div>
@endsection
      
@section('cardbody')        
    <div class="row no-gutters results-container">
        <div class="col-sm-6 active">
            {{ Form::open(['id' => 'position-form']) }}
                @foreach((array) $active as $item)
                    <div class="row no-gutters">
                        <input type="hidden" name="ids[]" value="{{ $item['id'] }}">
                        <div class="col-sm-9">
                            <a class="name" href="">{{ $item['name'] }}</a>
                        </div>
                        
                        <div class="col-sm-3">
                            <a class="btn deactivate"></a>
                        </div>
                    </div>
                @endforeach
            {{ Form::close() }}
        </div>
        <div class="col-sm-6 not-active">
            @foreach((array) $notActive as $item)
                <div class="row no-gutters">
                    <input type="hidden" name="ids[]" value="{{ $item['id'] }}">
                    <div class="col-sm-9">
                        <a class="name" href="">{{ $item['name'] }}</a>
                    </div>
                    
                    <div class="col-sm-3">
                        <a class="btn activate"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>        
@endsection

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
        <div></div>
        <div><input type="Submit" form="position-form" class="btn" ></input></div>
    </div>
@endsection

@section('pagespecificscripts')
    <script type="text/javascript">
        
        $(document).ready(function(){

            $(document).on('click', ".activate", function(){

                var name = $(this).closest('.row').find('.name').text();

                var clone = $(this).closest('.row').clone()
                clone.find('.activate').toggleClass('activate deactivate');
                $(".active").find('#position-form').append(clone);

                $(this).closest('.row').hide();
            });

            $(document).on('click', ".deactivate", function(){

                var name = $(this).closest('.row').find('.name').text();

                $(".not-active").append($(this).closest('.row'));
                $(this).toggleClass('deactivate activate');
            });

        });
    </script>
@endsection