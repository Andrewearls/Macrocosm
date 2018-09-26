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
        $pages = ceil( $count/16 );
        if ($page < 1) {
            return redirect()->route('shopping', ['page' => 1]);
        } elseif ($page > $pages) {
            return redirect()->route('shopping', ['page' => $pages]);
        }
    	$inventory = Inventory::skip(($page-1)*16)->take(16)->get()->toArray();        
        
        return view('shopping.index')->with(['inventory' => $inventory, 'pages' => $pages, 'page' => $page, 'count' => $count]);
    }


}

