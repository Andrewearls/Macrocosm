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
        $sessionCart = $request->session()->get('cart');
        $i =0;
        while ($i < count($sessionCart)) {
            $cart[] = Inventory::findOrFail($sessionCart[$i]);
            $i++;
        }
        // dd(empty($cart));
        return view('shopping.cart')->with(['cart' => $cart]);
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
            session([$item => '1']);
            // dd($request->session()->get('cart'));

        }       
        
        dd($request->session()->get('cart'));
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

