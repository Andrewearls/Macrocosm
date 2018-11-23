<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ShoppingItemValidator;
use App\Inventory;
use App\ExternalInventory;

class ShoppingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        // $count = Inventory::all()->count();
        // $pages = ceil( $count/12 );
        // if ($page < 1) {
        //     return redirect()->route('shopping', ['page' => 1]);
        // } elseif ($page > $pages && $pages > 0) {
        //     return redirect()->route('shopping', ['page' => $pages]);
        // }
    	$internalInventory = Inventory::all()->toArray();  

        $descriptionRoute = 'itemDescription';

        $externalInventory = ExternalInventory::all()->toArray();      
        
        return view('indexes.shopping')->with(['results' => $internalInventory, 'routeName' => $descriptionRoute, 'externalResults' => $externalInventory]);
    }

    public function inventoryDescription($id)
    {
        $result = Inventory::findOrFail($id);
        return view('descriptions.inventory')->with(['result' => $result]);
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
        return view('indexes.cart')->with(['cart' => $cart, 'total' => $cartTotal]);
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

    public function newInternalItem()
    {
        $result = new Inventory;
        return view('developer.shopping')->with(['result' => $result]);
    }

    //the following two should return the same view

    public function createInternalItem(ShoppingItemValidator $request)      
    {
        $user = Auth::user();
        $validated = $request->validated();
        $result = $user->inventory()->create($validated);
        
        return redirect()->route('itemDescription', ['id' => $result->id]);
    }

    public function editInternalItem($id)
    {
        $result = Inventory::findOrFail($id);
        $deleteRoute = route('deleteInternalShoppingItem', ['id' => $result->id]);
        return view('layouts.cards.developer')->with(['result' => $result, 'deleteRoute' => $deleteRoute]);
    }

    public function updateInternalItem(ShoppingItemValidator $request)
    {
        $validated = $request->validated();
        $result = Inventory::findOrFail($request->id);
        $result->name = $validated['name'];
        $result->price = $validated['price'];
        $result->description = $validated['description'];
        $result->save();
        return redirect()->route('itemDescription', ['id' => $result->id]);
    }

    public function deleteInternalItem($id)
    {
        $result = Inventory::findOrFail($id);
        $result->delete();
        return redirect()->route('shopping', ['page' => 1]);
    }


}

