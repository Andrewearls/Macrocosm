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
                                <div class="title">{{ $item->name }}</div>
                                <p>{{ $item->short_description }}</p>
                            </a>
                        @endforeach
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
