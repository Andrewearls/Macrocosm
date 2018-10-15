<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $badges = Badges::all()->toArray();
    	return view('badges.index')->with(['badges' => $badges]);
    }

    public function badgeDescription($id)
    {
        $badge = Badges::findOrFail($id);
        return view('badges.badgeDescription')->with(['item' => $badge]);
    }

    public function newBadge()
    {
        $item = new Badges;
        return view('developer.badgescms')->with(['item' => $item]);
    }

    public function createBadge(BadgesValidator $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $item = $user->badges()->create($validated);

        return redirect()->route('badgeDescription', ['id' => $item->id]);
    }

    public function editBadge($id)
    {
        $item = Badges::findOrFail($id);
        $deleteRoute = route('deleteBadge', ['id' => $item->id]);
        return view('developer.cms')->with(['item' => $item, 'deleteRoute' => $deleteRoute]);
    }

    public function updateBadge(BadgeValidator $request)
    {
        $validated = $request->validated();
        $item = BAdges::findOrFail($request->id);
        $item->name = $validated['name'];
        $item->description = $validated['description'];
        $item->save();
        return redirect()->route('BadgeDescription', ['id' => $item->id]);
    }

    public function deleteBadge($id)
    {
        $item = Badges::findOrFail($id);
        $item->delete();
        return redirect()->route('Badges');
    }
}
