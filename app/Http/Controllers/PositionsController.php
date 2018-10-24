<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PositionsValidator;
use App\Positions;
use App\User;

class PositionsController extends Controller
{
    public function listPositions()
    {
    	$positions = Positions::all();
    	return view('positions.index', ['results' => $positions]);
    }

    public function assignPosition($id)
    {
    	$position = Positions::findOrFail($id);
    	$assigned = $position->users;
    	$notAssigned = User::notAssigned($assigned);

    	return view('positions.assign', ['result' => $position, 'active' => $assigned->toArray(), 'notActive' => $notAssigned->toArray()]);
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
    	return view('positions.cms', ['result' => $position]);
    }

    public function createPosition(PositionsValidator $request)
    {
    	$validated = $request->validated();
    	$position = Positions::create($validated);
    	return redirect()->route('positions');
    }
}
