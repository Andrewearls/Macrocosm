<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;

class TrainingController extends Controller
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
    public function index(){
        $classes = Classes::all()->toArray();
    	return view('training.index')->with(['classes' => $classes]);
    }

    public function classDescription($id)
    {
        $class = Classes::findOrFail($id);
        return view('training.classDescription')->with(['item' => $class])        ;
    }

    public function editItem($id)
    {
        $item = Classes::findOrFail($id);
        return view('developer.cms')->with(['item' => $item]);
    }

    public function updateItem(Request $request)
    {
        return "here";
    }

    public function deleteItem($id)
    {
        return route()->back();
    }
}
