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
        $results = Classes::all()->toArray();
    	return view('training.index')->with(['results' => $results]);
    }

    public function classDescription($id)
    {
        $result = Classes::findOrFail($id);
        return view('training.classDescription')->with(['result' => $result])        ;
    }

    public function newItem()
    {
        $result = new Classes;
        return view('developer.classescms')->with(['result' => $result]);
    }

    public function createItem(TrainingClassesValidator $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $result = $user->classes()->create($validated);

        return redirect()->route('classDescription', ['id' => $result->id]);
    }

    public function editItem($id)
    {
        $result = Classes::findOrFail($id);
        $deleteRoute = route('deleteClassItem', ['id' => $result->id]);
        return view('developer.cms')->with(['result' => $result, 'deleteRoute' => $deleteRoute]);
    }

    public function updateItem(TrainingClassesValidator $request)
    {
        $validated = $request->validated();
        $result = Classes::findOrFail($request->id);
        $result->name = $validated['name'];
        $result->description = $validated['description'];
        $result->save();
        return redirect()->route('classDescription', ['id' => $result->id]);
    }

    public function deleteItem($id)
    {
        $result = Classes::findOrFail($id);
        $result->delete();
        return redirect()->route('training');
    }
}
