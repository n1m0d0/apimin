<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckInstitutions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $institution)
    {
        if(auth()->user()->institution->id == $institution) {
            return $next($request);
        } else {
            auth()->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });
            return response()->json([
                'message' => 'Successfully logged out'
            ], 200);
        }
    }
}
