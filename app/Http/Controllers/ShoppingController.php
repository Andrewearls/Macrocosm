<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inventory;

class ShoppingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {        
        $count = Inventory::all()->count();
        $pages = ceil( $count/12 );
        if ($page < 1) {
            return redirect()->route('shopping', ['page' => 1]);
        } elseif ($page > $pages) {
            return redirect()->route('shopping', ['page' => $pages]);
        }
    	$inventory = Inventory::skip(($page-1)*12)->take(12)->get()->toArray();        
        
        return view('shopping.index')->with(['inventory' => $inventory, 'pages' => $pages, 'page' => $page, 'count' => $count]);
    }

    public function inventoryDescription($id)
    {
        $item = Inventory::findOrFail($id);
        return view('shopping.itemDescription')->with(['item' => $item]);
    }

    public function cart(Request $request)
    {

        $cart = [];
        $cartTotal = 0;
        $sessionCart = $request->session()->get('cart.item');

        //below null $sessionCart is typecast to array
        foreach ((array) $sessionCart as $item => $amount) { 

            $retrieved = Inventory::findOrFail($item);
            $retrieved->amount = $amount;
            $cart[] = $retrieved;
            $cartTotal = $cartTotal + ($retrieved->price * $amount);
        }
        // dd(empty($cart));
        return view('shopping.cart')->with(['cart' => $cart, 'total' => $cartTotal]);
    }

    public function addToCart(Request $request)
    {
        // $request->session()->pull('cart');
        // return redirect()->back();

        $item = 'cart.item.'.$request->item;
        // dd($request->session()->get($item));
        if ($request->session()->has($item)) {
            $itemAmount = $request->session()->get($item);
            // dd($itemAmount);
            $itemAmount++;
            session([$item => $itemAmount]);
        } else {
            // dd($request->item);
            session([$item => 1]);
            // dd($request->session()->get('cart'));

        }       
        
        // dd($request->session()->get('cart'));
        return redirect()->back();
    }

    public function removeFromCart(Request $request)
    {
        $request->session()->pull($request->item);
        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $request->session()->pull('cart');
        return redirect()->back();
    }


}

