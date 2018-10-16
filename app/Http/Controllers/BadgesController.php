<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BadgesValidator;
use App\Badges;


class BadgesController extends Controller
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
        $results = Badges::all()->toArray();
    	return view('badges.index')->with(['results' => $results]);
    }

    public function badgeDescription($id)
    {
        $result = Badges::findOrFail($id);
        return view('badges.badgeDescription')->with(['result' => $result]);
    }

    public function newBadge()
    {
        $result = new Badges;
        return view('developer.cms')->with(['result' => $result]);
    }

    public function createBadge(BadgesValidator $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $result = $user->badges()->create($validated);

        return redirect()->route('badgeDescription', ['id' => $result->id]);
    }

    public function editBadge($id)
    {
        $result = Badges::findOrFail($id);
        $deleteRoute = route('deleteBadge', ['id' => $result->id]);
        return view('developer.cms')->with(['result' => $result, 'deleteRoute' => $deleteRoute]);
    }

    public function updateBadge(BadgesValidator $request)
    {
        $validated = $request->validated();
        $result = BAdges::findOrFail($request->id);
        $result->name = $validated['name'];
        $result->description = $validated['description'];
        $result->save();
        return redirect()->route('badgeDescription', ['id' => $result->id]);
    }

    public function deleteBadge($id)
    {
        $result = Badges::findOrFail($id);
        $result->delete();
        return redirect()->route('badges');
    }
}
