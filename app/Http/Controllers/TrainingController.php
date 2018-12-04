<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\TrainingClassesValidator;
use App\Classes;
use App\Requirement;
use App\Mail\Enroll;
use DateTime;
use Carbon\Carbon;



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
        $user = Auth::user();
        $classes = Classes::all();
        $results = $classes->map(function ($course) use ($user) {
            
            if ($user->requirements->contains('id', $course->requirement->id)) {
                $course->class = 'acquired';
                return $course;
            } elseif ($user->requirements->contains($course->requirments)) {
                $course->class = 'availible';
                return $course;
            } elseif ($user->enroll->contains($course)) {
                $course->class = 'enrolled';
                return $course;
            }else {
                $course->class = 'not-abailible';
                return $course;
            }
        });
        $descriptionRoute = 'classDescription';
    	return view('indexes.courses')->with(['results' => $results->toArray(), 'routeName' => $descriptionRoute]);
    }

    public function classDescription($id)
    {
        // dd(Auth::user()->classes);
        $class = Classes::findOrFail($id);
        $today = new Carbon();
        // This will update the date if it is behind
        // if ($class->date < $today) {
        //     // dd(true);
        //     $date = new Carbon($class->date);
        //     $difference = $date->diffInDays($today);
        //     $cyclesBehind = ceil($difference / $class->frequency);
        //     $newDate = $date->addDays($cyclesBehind * $class->frequency);
        //     $class->date = $newDate;
        //     $class->save();
        //     // dd($class->date);
        //     // dd($date);
        // }

        // dd('false');
        // dd(empty($result->requirements->toarray()));
        // dd(Auth::user()->requirements);
        //check if user meets class requirements
        //$user->meetsRequirements($class->requirements) -- returns true or false
        // dd( Auth::user()->meetsRequirements($class->requirements) );
        return view('descriptions.course')->with(['result' => $class]);
    }

    public function newItem()
    {
        $result = new Classes;
        return view('developer.course')->with(['result' => $result]);
    }

    public function createItem(TrainingClassesValidator $request)
    {
        $validated = $request->validated();
        $validated['name'] = ucwords(strtolower($validated['name']));
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
        return view('developer.course')->with(['result' => $result, 'deleteRoute' => $deleteRoute]);
    }

    public function updateItem(TrainingClassesValidator $request)
    {
        $validated = $request->validated();
        $class = Classes::findOrFail($request->id);
        $class->name = $validated['name'];
        $class->description = $validated['description'];
        $class->time = $validated['time'];
        $class->date = $validated['date'];
        $class->location = $validated['location'];
        $class->frequency = $validated['frequency'];
        $class->save();
        $class->requirement()->update(
            [
                'name' => $class->name.' Class',
                'description' => 'Default description',
            ]);


        return redirect()->route('editClassRequirements', ['id' => $class->id]);
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
        $notActive = $class->requirement->notActive($active);
        
        return view('activations.requirements')->with(['notActive' => $notActive->toArray(), 'active' => $active->toArray(), 'result' => $class]);  
    }

    public function updateClassRequirements(Request $request, $id)
    {
        $class = Classes::findOrFail($id);
        $class->requirements()->detach();
        $class->requirements()->attach($request->ids);
        return redirect()->route('classDescription', ['id' => $class->id]);
    }

    public function enroll($id)
    {
        $class = Classes::findOrFail($id);
        //if user meets class requirements
        // if(Auth::user()-> $class->requirements;
        // dd(Auth::user()->requirements);

        // $class->enroll()->attach(Auth::user()->id);
        Mail::to(Auth::user())->send(new Enroll($class));

        return new Enroll($class);// redirect()->route('classDescription', ['id' => $id]);
    }

    public function unenroll($id)
    {
        $class = Classes::findOrFail($id);
        $class->enroll()->detach(Auth::user()->id);
        return redirect()->route('classDescription', ['id' => $id]);
    }

    public function editClassEnrolled($id)
    {
        $class = Classes::findOrFail($id);
        $enrolled = $class->enroll->map(function ($user, $key) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'enrolled' => date('g:i a m/d/Y', strtotime($user->pivot->created_at)),
            ];
        });
        // dd($enrolled->first()->pivot->created_at);
        // dd($enrolled);

        return view('activations.enrollment')->with(['notActive' => $enrolled->toArray(), 'active' => [], 'result' => $class]);
    }

    public function updateClassEnrolled(Request $request, $id)
    {
        $class = Classes::findOrFail($id);
        $class->enroll()->detach($request->ids);
        $class->requirement->users()->attach($request->ids);
        // dd(Auth::user()->requirements);
        return redirect()->route('classDescription', ['id' => $id]);
    }
}
