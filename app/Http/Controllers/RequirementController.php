<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requirement;
use App\Badges;
use App\Http\Requests\RequirementValidator;

class RequirementController extends Controller
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
        $results = Requirement::all()->toArray();
    	return $results;
    }

    // public function badgeDescription($id)
    // {
    //     // $user = Auth::user();
    //     $result = Badges::findOrFail($id);
    //     return view('badges.badgeDescription')->with(['result' => $result]);
    // }

    public function newRequirement()
    {
        $result = new Requirement;
        return view('developer.cms')->with(['result' => $result]);
    }

    public function createRequirement(RequirementValidator $request)
    {
        $validated = $request->validated();
        // $user = Auth::user();
        $result = Requirement::create($validated);

        return $result;
    }

    public function editRequirement($id)
    {
        $result = Requirement::findOrFail($id);
        $deleteRoute = route('deleteRequirement', ['id' => $result->id]);
        return view('developer.cms')->with(['result' => $result, 'deleteRoute' => $deleteRoute]);
    }

    public function updateRequirement(RequirementValidator $request)
    {
        $validated = $request->validated();
        $result = Requirement::findOrFail($request->id);
        $result->name = $validated['name'];
        $result->description = $validated['description'];
        $result->save();
        return redirect()->route('badgeDescription', ['id' => $result->id]);
    }

    public function deleteRequirement($id)
    {
        $result = Requirement::findOrFail($id);
        $result->delete();
        return redirect()->route('home');
    }

    public function test()
    {
        // $requirement = new Requirement;
        // $badge = Badges::find(1);
        // $badge->requirement()->firstOrCreate([
        //     'name' => $badge->name.' '.$badge->type(),
        //     'description' => 'Default description',
        // ]);
        // $requirement->name = 'named3';
        // $requirement->description = 'a description';
        // $requirement->specific()->create($badge->toArray());
        // $badge->requirement()->delete();
        // $requirement->specific()->create($badge->toArray());

        // $badge->requirement()->save($requirement);
        // dd(Requirement::all());

        return Requirement::all();
    }
}
