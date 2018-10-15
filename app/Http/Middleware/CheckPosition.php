<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
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

        if ($user->position->name != $requiredPosition) {
            return redirect()->back();
        }
        return $next($request);
    }
}
