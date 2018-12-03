<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\BadgesValidator;
use App\Badges;
use App\Requirement;


class BadgesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // parent::__construct();
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $badges = Badges::all();
        $results = $badges->map(function ($badge) use ($user) {
            
            if ($user->requirements->contains('id', $badge->requirement->id)) {
                $badge->class = 'acquired';
                return $badge;
            } elseif ($user->requirements->contains($badge->requirments)) {
                $badge->class = 'availible';
                return $badge;
            }else {
                $badge->class = 'not-abailible';
                return $badge;
            }
        });
        $descriptionRoute = 'badgeDescription';
    	return view('indexes.badges')->with(['results' => $results->toArray(), 'routeName' => $descriptionRoute]);
    }

    public function badgeDescription($id)
    {
        // $user = Auth::user();
        $result = Badges::findOrFail($id);
        return view('descriptions.badge')->with(['result' => $result]);
    }

    public function newBadge()
    {
        $result = new Badges;
        return view('layouts.cards.developer')->with(['result' => $result]);
    }

    public function createBadge(BadgesValidator $request)
    {
        $validated = $request->validated();
        $validated['name'] = ucwords(strtolower($validated['name']));
        $user = Auth::user();
        $badge = $user->badge()->create($validated);
        $badge->requirement()->create(
            [
                'name' => $badge->name.' Badge',
                'description' => 'Default description',
            ]
        );
        

        return redirect()->route('badgeDescription', ['id' => $badge->id]);
    }

    public function editBadge($id)
    {
        $result = Badges::findOrFail($id);
        $deleteRoute = route('deleteBadge', ['id' => $result->id]);
        return view('developer.badge')->with(['result' => $result, 'deleteRoute' => $deleteRoute]);
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
        $badge->requirements()->delete();
        $badge->requirement->delete();
        $badge->delete();
        return redirect()->route('badges');
    }

    public function editBadgeRequirements($id)
    {
        $badge = Badges::findOrFail($id);
        $active = $badge->requirements;
        $notActive = $badge->requirement->notActive($active);
        return view('activations.requirements')->with(['notActive' => $notActive->toArray(), 'active' => $active->toArray(), 'result' => $badge]);
    }

    public function updateBadgeRequirements(Request $request, $id)
    {
        $badge = Badges::findOrFail($id);
        $badge->requirements()->detach();
        $badge->requirements()->attach($request->ids);
        return redirect()->route('badgeDescription', ['id' => $badge->id]);
    }

    public function claim($id)
    {
        $badge = Badges::findOrFail($id);
        // Auth::user()->requirements()->attach($badge->requirement->id);
        return redirect()->route('badgeDescription', ['id' => $badge->id]);
    }

    public function test()
    {
        $user = Auth::user();
        // Assign badge to user
        // $user->badges()->create($badge->toArray());
        


        return $user->badges;
    }
}
