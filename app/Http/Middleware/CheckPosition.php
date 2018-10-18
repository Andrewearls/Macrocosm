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
        
        if (Positions::where('name', '=', $requiredPosition)->exists()) {            
            if ($user->position->name != $requiredPosition) {
                return redirect()->back();
            }
        }
        
        return $next($request);
    }
}
