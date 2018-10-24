<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Positions;
use Closure;

class CheckPosition
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $requiredPosition)
    {
        $user = Auth::user();
        $result = Positions::where('name', '=', $requiredPosition)->first();           
        
        if (!is_null($result)) {
            if (!$user->positions->contains('id', $result->id)) {
                return 'here'; //redirect()->route('home');
            }
        }
        
        return $next($request);
    }
}
