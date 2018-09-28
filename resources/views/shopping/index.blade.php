@extends('layouts.app')

@section('content')
<div class="container shopping">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            Shopping
                        </div>
                        <div class="col-sm-6 display-count">
                            <span>{{ (($page * 12) <= $count) ? $page * 12 : $count }}</span> of {{ $count }}
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
                        @foreach ($inventory as $item)
                            <a href="{{ route('itemDescription', ['id' => $item['id']]) }}" class="col-md-3 item-container">
                                <img src="{{ $item['image'] }}">
                                <!-- <i class="fas fa-shopping-bag fa-5x"></i> -->
                                <div class="title">
                                    @if(strlen($item['name']) > 8)
                                        {{ substr($item['name'], 0, 8) }}...
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
                                <a {{ ($page-1 > 0) ? "href=".route('shopping', ['page' => $page-1]) : '' }}><i class="fas fa-arrow-circle-left fa-3x"></i></a>
                            </div>
                            <div class="col-sm-6 page-numbers">
                                @if ($page-1 > 0)
                                    <a href="{{ route('shopping', [$page-1]) }}">{{ $page-1 }}</a>
                                @endif
                                <span>{{ $page }}</span>
                                @if ($page+1 <= $pages) 
                                    <a href="{{ route('shopping', [$page+1]) }}">{{ $page+1 }}</a> 
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <a {{ ($page+1 <= $pages) ? "href=".route('shopping', ['page' => $page+1]) : '' }}><i class="fas fa-arrow-circle-right fa-3x"></i></a>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
