@extends('layouts.cards.index')

@section('cardheader')
    <div class="row justify-content-between">
        <div class="col-5 title">
            Payment Method
        </div>
    </div>
@endsection

@section('cardbody')
	<div class="row no-gutters justify-content-center">
		<div class="col-8"> 
			@foreach((array) $results as $result)
				<div class="row">
					<div class="col-6">Name</div>
					<div class="col-3">Type</div>
					<div class="col-3">Last 4 Digets</div>
				</div>
			@endforeach
		    {{ Form::open(array('url' => route('checkout'), 'id' => 'payment-form')) }}

				<div class="form-row row no-gutters justify-content-between">
			        <label for="card-element" class="col-5">
			          <span>Credit or debit card</span>
			        </label>
			        <div id="card-element" class="col-7 btn">
			          <!-- A Stripe Element will be inserted here. -->
			        </div>

			        <!-- Used to display form errors. -->
			        <div id="card-errors" role="alert"></div>
			    </div>
			    
		    {{ Form::close() }}
		</div>
	</div>

@endsection

@section('cardfooter')
	<div class="row no-gutters justify-content-end">
    	<div class="col-2">
		    <button class="btn" form="payment-form">Continue</button>
		</div>
	</div>
@endsection


@section('pagespecificscripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var stripe = Stripe('pk_test_C8AuNFfPZTxe6RCdgeEnNlG9');
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            var style = {
              base: {
                // Add your base input styles here. For example:
                fontSize: '20px',
                color: "gray",
              }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Create a token or display an error when the form is submitted.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the customer that there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        });
    </script>
@endsection