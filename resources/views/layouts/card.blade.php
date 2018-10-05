@extends('layouts.app')

@section('content')
<div @yield('id')>
    <div class="card">
        <div class="card-header">            
            @yield('cardheader')              
        </div>

        <div class="card-body container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @yield('cardbody')

        </div>
        <div class="card-footer">                           
            @yield('cardfooter')            
        </div>
    </div>
</div>
@endsection

@section('pagespecificscripts')

@endsection
