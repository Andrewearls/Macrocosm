<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpeditionValidator;
use App\Expeditions;

class ExpeditionsController extends Controller
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
    public function index()
    {
        $results = Expeditions::all()->toArray();
    	return view('expeditions.index')->with(['results' => $results]);
    }

    public function expeditionDescription($id)
    {
    	$result = Expeditions::findOrFail($id);
    	return view('expeditions.expeditionDescription')->with(['result' => $result]);
    }

    public function newExpedition()
    {
    	$result = new Expeditions;
    	return view('developer.cms')->with(['result' => $result]);
    }

    public function createExpedition(ExpeditionValidator $request)
    {
    	$validated = $request->validated();
    	$user = Auth::user();
        $result = $user->expeditions()->create($validated);

        return redirect()->route('expeditionDescription', ['id' => $result->id]);
    }

    public function editExpedition($id)
    {
        $result = Expeditions::findOrFail($id);
        $deleteRoute = route('deleteExpedition', ['id' => $result->id]);
        return view('developer.cms')->with(['result' => $result, 'deleteRoute' => $deleteRoute]);
    }

    public function updateExpedition(ExpeditionValidator $request)
    {
        $validated = $request->validated();
        $result = Expeditions::findOrFail($request->id);
        $result->name = $validated['name'];
        $result->description = $validated['description'];
        $result->save();
        return redirect()->route('expeditionDescription', ['id' => $result->id]);
    }

    public function deleteExpedition($id)
    {
        $result = Expeditions::findOrFail($id);
        $result->delete();
        return redirect()->route('expeditions');
    }
}
