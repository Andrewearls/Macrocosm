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
        return view('training.classDescription')->with(['class' => $class])        ;
    }
}
