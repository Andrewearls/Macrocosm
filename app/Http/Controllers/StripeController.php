<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index()
    {
    	return view('indexes.paymentMethod', ['results' => []]);
    }

    private static function subscribe($token)
    {
		Auth::user()->newSubscription('main', 'test')->create($request->stripeToken, []);
    }

    public function checkout(Request $request)
    {
    	// dd($request->all());
    	// $this->subscribe($request->stripeToken);

    	$cart = [];
        $cartTotal = 0;
        $sessionCart = $request->session()->get('cart.item');

        //below $sessionCart is typecast to (array)
        foreach ((array) $sessionCart as $item => $amount) { 

            $retrieved = Inventory::findOrFail($item);
            $retrieved->amount = $amount;
            $cart[] = $retrieved;
            $cartTotal = $cartTotal + ($retrieved->price * $amount);
        }

        dd($cartTotal);

    	return view('indexes.checkout', ['results' => [], 'cart' => $cart, 'cartTotal' => $cartTotal]);
    }

    public function charge(Request $request)
    {    	
    	Auth::user()->charge($amount);
    	return 'success';
    }

    public function unsubscribe(Request $request)	
    {
    	//cancel now
		Auth::user()->subscription('main')->cancelNow(); 
		//cancel at the end of subscription
		//Auth::user()->subscription('main')->cancel;   
		return 'success';	
    }

    public function updateCard(Request $request)
    {
    	$token = $request->stripeToken;
    	Auth::user()->updateCard($token);
    }
}
