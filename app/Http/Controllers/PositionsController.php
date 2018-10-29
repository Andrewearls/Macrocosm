<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\PositionsValidator;
use App\Positions;
use App\User;

class PositionsController extends Controller
{
    public function listPositions()
    {
    	$positions = Positions::all();
    	return view('indexes.positions', ['results' => $positions]);
    }

    public function assignPosition($id)
    {
    	$position = Positions::findOrFail($id);
    	$assigned = $position->users;
    	$notAssigned = User::notAssigned($assigned);

    	return view('activations.positions', ['result' => $position, 'active' => $assigned->toArray(), 'notActive' => $notAssigned->toArray()]);
    }

    public function submitAssignments(Request $request, $id)
    {
    	$position = Positions::findOrFail($id);
    	//This is funky and needs to be fixed (later)
        $position->users()->detach();
        $position->users()->attach($request->ids);
        return redirect()->route('positions');
    }

    public function newPosition()
    {
    	$position = new Positions;
    	return view('developer.positioncms', ['result' => $position]);
    }

    public function createPosition(PositionsValidator $request)
    {
    	$validated = $request->validated();
    	$position = Positions::create($validated);
    	$position->requirement()->create(
            [
                'name' => $position->name.' Position',
                'description' => 'Default description',
            ]);
    	return redirect()->route('positions');
    }

    public function editPosition($id)
    {
    	$position = Positions::findOrFail($id);

    	return view('positions.cms', ['result' => $position]);
    }

    public function updatePosition(PositionsValidator $request, $id)
    {
    	$validated = $request->validated();
    	$position = Positions::findOrFail($id);
    	$position->name = $validated['name'];
    	$position->save();

    	return redirect()->route('positions');
    }

    public function deletePosition($id)	
    {
    	$position = Positions::findOrFail($id);
    	// $position->requirements()->delete();
        $position->requirement->delete();
        $position->delete();

        return redirect()->route('positions');
    }

    public function myPositions()
    {
    	return Auth::user()->positions;

    }
}
