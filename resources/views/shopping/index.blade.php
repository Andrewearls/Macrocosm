@extends('layouts.app')

@section('content')
<div class="container shopping">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Shopping</div>

                <div class="card-body container">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row no-gutters">
                        @foreach ($inventory as $item)
                            <a class="col-md-3 item-container">
                                <img src="https://picsum.photos/200/200">
                                <!-- <i class="fas fa-shopping-bag fa-5x"></i> -->
                                <div class="title">
                                    @if(strlen($item['name']) > 9)
                                        {{ substr($item['name'], 0, 9) }}...
                                    @else
                                        {{ $item['name'] }}
                                    @endif
                                </div>
                                        
                                <p>                                    
                                    @if(strlen($item['short_description']) > 15)
                                        {{ substr($item['short_description'], 0, 15) }}...
                                    @else
                                        {{ $item['short_description'] }}
                                    @endif
                                </p>
                            </a>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-3">
                                <a href=""><i class="fas fa-arrow-circle-left fa-3x"></i></a>
                            </div>
                            <div class="col-sm-6 page-numbers">
                                <span>1</span>23
                            </div>
                            <div class="col-sm-3">
                                <a href=""><i class="fas fa-arrow-circle-right fa-3x"></i></a>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
