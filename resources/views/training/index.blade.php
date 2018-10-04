@extends('layouts.app')

@section('content')
<div class="container training">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            Training
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
                        
                    </div>
                    
                    

                </div>
                <div class="card-footer">
                    <div class="row">
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
