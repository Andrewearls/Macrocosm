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
                            <a class="col-md-3 item-container">
                                <img src="https://images.unsplash.com/photo-1533419784160-1f7f79022119?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=3cc8690dc35ae8378b6ccc04c4d57fbf&auto=format&fit=crop&w=746&q=80" class="fas fa-shopping-bag fa-5x">
                                <!-- <i class="fas fa-shopping-bag fa-5x"></i> -->
                                <div class="title">This Item</div>
                                <p>Short description</p>
                            </a>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
