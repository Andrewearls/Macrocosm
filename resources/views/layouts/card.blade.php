@extends('layouts.app')

@section('content')
<div @yield('layoutid')>
    @yield('beforeCard', '')
    <div class="card" @yield('pagespecificid', '')>
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
    @yield('afterCard','')
</div>
@endsection

@section('pagespecificscripts')

@endsection
