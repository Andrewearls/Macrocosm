@extends('layouts.card')

@section('layoutid')
    id="requirements"
@endsection

@section('cardheader')
    <div class="row justify-content-between">
        <div class="col-sm-5">
            List of Requirements
        </div>        
    </div>
@endsection
      
@section('cardbody')        
    <div class="row no-gutters results-container">
        <div class="col-sm-6 left">
            @foreach((array) $active as $item)
                <div class="row no-gutters">
                    <div class="col-sm-4">
                        <a href="">{{ $item['name'] }}</a>
                    </div>
                    <div class="col-sm-6">
                        {{ $item['description'] }}
                    </div>
                    <div class="col-sm-2">
                        <a class="btn" href="">Remove</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-6 right">
            @foreach((array) $notActive as $item)
                <div class="row no-gutters">
                    <div class="col-sm-4">
                        <a class="name" href="">{{ $item['name'] }}</a>
                    </div>
                    <div class="col-sm-6">
                        {{ $item['description'] }}
                    </div>
                    <div class="col-sm-2">
                        <a class="btn activate-requirement">Add</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>        
@endsection

@section('cardfooter')
    <div class="row justify-content-between no-gutters">
        <div></div>
        <div><a class="btn" href="">Submit</a></div>
    </div>
@endsection

@section('pagespecificscripts')
    <script type="text/javascript">
        
        $(document).ready(function(){
            var id = "{{ $badge->id }}";

            $(".activate-requirement").click(function(){

                var name = $(this).closest('.row').find('.name').text();
                var route = "{{ route('activateRequirement') }}";

                postToRequirements(route, name);
                $(this).closest('.row').hide();
            });

            function postToRequirements(route, name) {
                $.post(  route,
                {
                  '_token': $('meta[name=csrf-token]').attr('content'),
                  badge: id,
                  requirement: name
                },
                function(data,status){

                    console.log(data);
                });
            }
        });
    </script>
@endsection