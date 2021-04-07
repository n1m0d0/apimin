<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiAuthController extends Controller
{

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }
    
    public function login(Request $request)
    {
       
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'state' => 'ACTIVO'
        ])) {
            $user = auth()->user();
            $success = $user
                ->createToken($user->name.'-'.$user->institution->name)
                ->accessToken;
            return response()->json([
                'access_token' => $success,
                'token_type' => 'Bearer'
            ], 200);

        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function getUser() {
        return response()->json(auth()->user());
    }
}
