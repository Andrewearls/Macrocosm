@extends('layouts.card')

@section('layoutid')
    id="dashboard"
@endsection

@section('cardheader')
    <div class="row justify-content-between">
        <div class="col-sm-5 title">
            Dashboard
        </div>
    </div>
@endsection

@section('cardbody')                
    <div class="row no-gutters">
        <div class="col-md-6 left">
            <a href="{{ route('shopping', ['page' => 1]) }}" class="row no-gutters">                       
                <div class="col-md-8">
                    <div class="title">Shopping</div>
                    <p>Shop the macrocosmic-store!</p>
                </div> 
                <div class="col-md-4 hidden-sm-down icon">
                    <i class="fas fa-shopping-bag fa-5x"></i>
                </div>                       
            </a>
            <a href="{{ route('badges') }}" class="row no-gutters">                       
                <div class="col-md-8">
                    <div class="title">Badges</div>
                    <p>View your recent achievements!</p>
                </div> 
                <div class="col-md-4 hidden-sm-down icon">
                    <i class="fas fa-shield-alt fa-5x"></i>
                </div>                       
            </a>
        </div>
        <div class="col-md-6 right">
            <a href="{{ route('training') }}" class="row no-gutters">   
                <div class="col-md-4 hidden-sm-down icon">
                    <i class="fas fa-bullseye fa-5x"></i>
                </div>                   
                <div class="col-md-8">
                    <div class="title">Training</div>
                    <p>Hone your Explorer skills!</p>
                </div>   
            </a>
            <a href="{{ route('expeditions') }}" class="row no-gutters">   
                <div class="col-md-4 hidden-sm-down icon">
                    <i class="fas fa-flag fa-5x"></i>
                </div>                   
                <div class="col-md-8">
                    <div class="title">Expedition</div>
                    <p>Join a macrocosmic-adventure!</p>
                </div>   
            </a>
        </div>        
    </div>
    <div class="row justify-content-center no-gutters comming-soon">
        <div class="col-sm-12 title more-comming">
            More To Come!
        </div>
    </div>
@endsection

@section('cardfooter')

@endsection

@section('pagespecificscripts')

@endsection