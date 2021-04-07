<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ApiProfileController extends Controller
{
    
    public function index()
    {
        $profiles = Profile::where('state', 'ACTIVO')->get();
       
        return response()->json([
            'data' => $profiles
        ], 200);
    }

    public function store(Request $request)
    {
        $profile = new Profile;
        $profile->name = $request->name;
        $profile->state = 'ACTIVO';
        $profile->save();

        return response()->json([
            'data' => $profile
        ], 201);
    }

    public function show($id)
    {
        $profile = Profile::find($id);
        
        if($profile) {
            return response()->json([
                'data' => $profile
            ], 200);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }   
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);
        if($profile) {
            $profile->name = $request->name;
            $profile->save();

            return response()->json([
                'data' => $profile
            ], 201);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $profile = Profile::find($id);
        if($profile) {
            $profile->state = 'INACTIVO';
            $profile->save();

            return response()->json([
                'data' => $profile
            ], 201);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }
    }
}
