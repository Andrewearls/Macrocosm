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

    public function listRequirements($id)
    {
        $badge = Requirement::where('specific_id', $id)
                            ->where('specific_type', 'App\Badges')
                            ->first()->specific;
        // dd($badge);
        $notActive = Requirement::all()->toArray();
        $active = $badge->requirements;
        return view('requirements.index')->with(['notActive' => $notActive, 'active' => $active->toArray(), 'badge' => $badge]);
    }

    public function activateRequirement(Request $request)
    {
        $requirement = Requirement::where('name', $request->requirement)->first();
        $badge = Requirement::where('specific_id', $request->badge)
                            ->where('specific_type', 'App\Badges')
                            ->first()->specific;
        // $badge->requirements()->create($requirement);
        return $badge;
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

        // return Requirement::all();

        $requirement = Requirement::where('name', 'name Class')->first();
        $badge = Requirement::where('specific_id', 7)
                            ->where('specific_type', 'App\Badges')
                            ->first()->specific;
        // $requirement->badges()->attach($badge->id);
        return $requirement->badges;
    }
}
