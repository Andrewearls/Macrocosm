@extends('layouts.app')

@section('content')
<div class="container dashboard">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body container">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row no-gutters">
                        <div class="col-md-6 left">
                            <a class="row">                       
                                <div class="col-md-8">
                                    <div class="title">Shopping</div>
                                    <p>Shop the macrocosmic-store!</p>
                                </div> 
                                <div class="col-md-4 hidden-sm-down">
                                    <i class="fas fa-shopping-bag fa-5x"></i>
                                </div>                       
                            </a>
                            <a class="row">                       
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
                            <a class="row">   
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
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
