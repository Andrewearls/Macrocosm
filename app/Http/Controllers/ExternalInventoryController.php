<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExternalInventory;
use App\Http\Requests\ExternalInventoryValidator;



class ExternalInventoryController extends Controller
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
        $item = new ExternalInventory;
    	return view('developer.externalInventory')->with(['result' => $item]);
    }    

    public function createInventoryItem(ExternalInventoryValidator $request)
    {
        $validated = $request->validated();
        ExternalInventory::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'link' => $validated['link'],
            'image' => htmlentities($validated['image']),
        ]);

        return redirect()->route('shopping', ['page' => 1]);
    }

    public function deleteInventoryItem($id)
    {
        $item = ExternalInventory::findOrFail($id);
        $item->delete();
        return redirect()->route('shopping', ['page' => 1]);
    }
}
