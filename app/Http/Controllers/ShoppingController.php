<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ShoppingItemValidator;
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
        // return $request->id;
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
        return 'sucess';
    }

    public function removeFromCart(Request $request)
    {
        $item = 'cart.item.'.$request->item;
        // dd($request->session()->get($item));
        if ($request->session()->has($item)) {
            $itemAmount = $request->session()->get($item);
            // dd($itemAmount);
            $itemAmount--;
            if ($itemAmount <= 0) {
                $request->session()->forget($item);
            }else{
                session([$item => $itemAmount]);
            }            
        }    

        // dd($request->session()->get('cart'));
        return 'sucess';
        // $request->session()->pull($request->item);
        // return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $request->session()->pull('cart');
        return redirect()->back();
    }

    public function clearItem(Request $request)
    {
        $item = 'cart.item.'.$request->item;
        // dd($request->session()->get($item));
        if ($request->session()->has($item)) {
            $itemAmount = $request->session()->forget($item);
        } 
        
        return 'sucess';
        
    }

    public function newItem()
    {
        $item = new Inventory;
        // $item->price = 1;
        // return Route::currentRouteName();
        return view('developer.shoppingcms')->with(['item' => $item]);
    }

    public function createItem(ShoppingItemValidator $request)      
    {
        $user = Auth::user();
        $validated = $request->validated();
        $item = $user->inventory()->create($validated);
        
        return redirect()->route('itemDescription', ['id' => $item->id]);
    }

    public function editItem($id)
    {
        $item = Inventory::findOrFail($id);
        $deleteRoute = route('deleteShoppingItem', ['id' => $item->id]);
        return view('developer.cms')->with(['item' => $item, 'deleteRoute' => $deleteRoute]);
    }

    public function updateItem(ShoppingItemValidator $request)
    {
        $validated = $request->validated();
        $item = Inventory::findOrFail($request->id);
        $item->name = $validated['name'];
        $item->price = $validated['price'];
        $item->description = $validated['description'];
        $item->save();
        return redirect()->route('itemDescription', ['id' => $item->id]);
    }

    public function deleteItem($id)
    {
        $item = Inventory::findOrFail($id);
        $item->delete();
        return redirect()->route('shopping', ['page' => 1]);
    }


}

