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
    public function index()
    {
        $currentPage = 2;
        $count = Inventory::all()->count();
    	$inventory = Inventory::skip(($page-1)*16)->take(16)->get();        
        $pages = ceil( $inventory/16 );
        return view('shopping.index')->with(['inventory' => array_slice($inventory->toArray(),1,16)]);
    }


}

