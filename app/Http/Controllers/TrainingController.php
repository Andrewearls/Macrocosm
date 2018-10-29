<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TrainingClassesValidator;
use App\Classes;
use App\Requirement;


class TrainingController extends Controller
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
    public function index(){
        $results = Classes::all()->toArray();
        $descriptionRoute = 'classDescription';
    	return view('indexes.courses')->with(['results' => $results, 'routeName' => $descriptionRoute]);
    }

    public function classDescription($id)
    {
        $result = Classes::findOrFail($id);
        return view('descriptions.course')->with(['result' => $result])        ;
    }

    public function newItem()
    {
        $result = new Classes;
        return view('developer.class')->with(['result' => $result]);
    }

    public function createItem(TrainingClassesValidator $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $class = $user->classes()->create($validated);
        $class->requirement()->create(
            [
                'name' => $class->name.' Class',
                'description' => 'Default description',
            ]);

        return redirect()->route('classDescription', ['id' => $class->id]);
    }

    public function editItem($id)
    {
        $result = Classes::findOrFail($id);
        $deleteRoute = route('deleteClassItem', ['id' => $result->id]);
        return view('developer.editClass')->with(['result' => $result, 'deleteRoute' => $deleteRoute]);
    }

    public function updateItem(TrainingClassesValidator $request)
    {
        $validated = $request->validated();
        $class = Classes::findOrFail($request->id);
        $class->name = $validated['name'];
        $class->description = $validated['description'];
        $class->save();
        $class->requirement()->update(
            [
                'name' => $class->name.' Class',
                'description' => 'Default description',
            ]);


        return redirect()->route('classDescription', ['id' => $class->id]);
    }

    public function deleteItem($id)
    {
        $class = Classes::findOrFail($id);
        $class->requirement()->delete();
        $class->delete();
        return redirect()->route('training');
    }

    public function editClassRequirements($id)
    {
        $class = Classes::findOrFail($id);
        $active = $class->requirements;
        $notActive = Requirement::notActive($active);
        return view('requirements.index')->with(['notActive' => $notActive->toArray(), 'active' => $active->toArray(), 'result' => $class]);  
    }

    public function updateClassRequirements(Request $request, $id)
    {
        $class = Classes::findOrFail($id);
        $class->requirements()->detach();
        $class->requirements()->attach($request->ids);
        return redirect()->route('classDescription', ['id' => $class->id]);
    }
}
