<?php

namespace App\Http\Controllers;

use App\Http\Requests\CMS;

class DeveloperController extends Controller
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
        return view('developer.cms');
    }

    public function formSubmit(CMS $request)
    {
    	$validated = $request->validated();

    	switch ($validated["type"]) {
    		case 'item':
    			return redirect()->route('createItem');
    			break;
    		
    		case 'class':
    			return redirect()->route('createClass');
    			break;

    		default:
    			return back();
    			break;
    	}

    	return route('404');
    }
}
