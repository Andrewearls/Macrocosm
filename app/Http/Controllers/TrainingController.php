<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TrainingClassesValidator;
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

    public function newItem()
    {
        $item = new Classes;
        return view('developer.classescms')->with(['item' => $item]);
    }

    public function createItem(TrainingClassesValidator $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $item = $user->classes()->create($validated);

        return redirect()->route('classDescription', ['id' => $item->id]);
    }

    public function editItem($id)
    {
        $item = Classes::findOrFail($id);
        $deleteRoute = route('deleteClassItem', ['id' => $item->id]);
        return view('developer.cms')->with(['item' => $item, 'deleteRoute' => $deleteRoute]);
    }

    public function updateItem(TrainingClassesValidator $request)
    {
        $validated = $request->validated();
        $item = Classes::findOrFail($request->id);
        $item->name = $validated['name'];
        $item->description = $validated['description'];
        $item->save();
        return redirect()->route('classDescription', ['id' => $item->id]);
    }

    public function deleteItem($id)
    {
        $item = Classes::findOrFail($id);
        $item->delete();
        return redirect()->route('training');
    }
}
