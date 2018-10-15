@extends('layouts.card')

@section('layoutid')
    id="dashboard"
@endsection

@section('cardheader')
    Dashboard
@endsection

@section('cardbody')                
    <div class="row no-gutters comming-soon">
        <div class="col-md-6 left">
            <a href="{{ route('shopping', ['page' => 1]) }}" class="row">                       
                <div class="col-md-8">
                    <div class="title">Shopping</div>
                    <p>Shop the macrocosmic-store!</p>
                </div> 
                <div class="col-md-4 hidden-sm-down">
                    <i class="fas fa-shopping-bag fa-5x"></i>
                </div>                       
            </a>
            <a href="{{ route('badges') }}" class="row">                       
                <div class="col-md-8">
                    <div class="title">Badges</div>
                    <p>View your recent achievements!</p>
                </div> 
                <div class="col-md-4 hidden-sm-down">
                    <i class="fas fa-shield-alt fa-5x"></i>
                </div>                       
            </a>
        </div>
        <div class="col-md-6 right">
            <a href="{{ route('training') }}" class="row">   
                <div class="col-md-4 hidden-sm-down">
                    <i class="fas fa-bullseye fa-5x"></i>
                </div>                   
                <div class="col-md-8">
                    <div class="title">Training</div>
                    <p>Hone your Explorer skills!</p>
                </div>   
            </a>
            <a class="row">   
                <div class="col-md-4 hidden-sm-down">
                    <i class="fas fa-flag fa-5x"></i>
                </div>                   
                <div class="col-md-8">
                    <div class="title">Expedition</div>
                    <p>Join a macrocosmic-adventure!</p>
                </div>   
            </a>
        </div>
    </div>
@endsection

@section('cardfooter')

@endsection

@section('pagespecificscripts')

@endsection