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
    public function index()
    {
        $results = Badges::all()->toArray();
    	return view('badges.index')->with(['results' => $results]);
    }

    public function badgeDescription($id)
    {
        // $user = Auth::user();
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
        $badge = $user->badge()->create($validated);
        $badge->requirement()->create(
            [
                'name' => $badge->name.' Badge',
                'description' => 'Default description',
            ]);
        

        return redirect()->route('badgeDescription', ['id' => $badge->id]);
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
        $badge = Badges::findOrFail($request->id);
        // dd($result->requirement->id);
        $badge->name = $validated['name'];
        $badge->description = $validated['description'];
        
        $badge->save();
        $badge->requirement()->update(
            [
                'name' => $badge->name.' Badge',
                'description' => 'Default description',
            ]);
        return redirect()->route('badgeDescription', ['id' => $badge->id]);
    }

    public function deleteBadge($id)
    {
        $badge = Badges::findOrFail($id);
        $badge->requirement->delete();
        $badge->delete();
        return redirect()->route('badges');
    }

    public function test()
    {
        $user = Auth::user();
        // Assign badge to user
        // $user->badges()->create($badge->toArray());
        


        return $user->badges;
    }
}
