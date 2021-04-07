<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Permission;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $system, $profile)
    {
        $data = Permission::where('user_id', auth()->user()->id)->where('system_id', $system)->where('profile_id', $profile)->get()->first();
        
        if($data) {
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
