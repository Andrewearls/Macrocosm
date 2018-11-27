@extends('layouts.cards.activation')

@section('pagespecificid')
	id='enrollment'
@endsection

@section('cardheader')
	<div class="row justify-content-between no-gutters">
        <div class="col-6 title">
            Passed:
        </div>
        <div class="col-6 title">
        	Enrolled:
        </div>
    </div>
@endsection

@section('cardbody')
    <div class="row no-gutters results-container">
        <div class="col-6 active">
        	<div class="row no-gutters table-header">
        		<div class="col-4">
        			Explorer
        		</div>
        		<div class="col-5">
        			Date Passed
        		</div>
        	</div>
            {{ Form::open(['id' => 'activation-form']) }}
                @foreach((array) $active as $item)
                    <div class="row no-gutters">
                        <input type="hidden" name="ids[]" value="{{ $item['id'] }}">
                        <div class="col-4">
                            <a class="name" href="">{{ $item['name'] }}</a>
                        </div>
                        <div class="col-5">
                        	Date -- -- 
                        </div>
                        <div class="col-3">
                            <button class="btn btn-red deactivate"></button>
                        </div>
                    </div>
                @endforeach
            {{ Form::close() }}
        </div>
        <div class="col-6 not-active">
        	<div class="row no-gutters table-header">
        		<div class="col-4">
        			Explorer
        		</div>
        		<div class="col-5">
        			Date Enrolled
        		</div>
        	</div>
            @foreach((array) $notActive as $item)
                <div class="row no-gutters">
                    <input type="hidden" name="ids[]" value="{{ $item['id'] }}">
                    <div class="col-4">
                        <a class="name" >{{ $item['name'] }}</a>
                    </div>
                    <div class="col-5">
                    	{{ $item['enrolled'] }}
                    </div>
                    <div class="col-3">
                        <button class="btn activate"></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div> 
@endsection