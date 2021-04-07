<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class ApiSystemController extends Controller
{
    public function index()
    {
        $systems = System::where('state', 'ACTIVO')->get();
       
        return response()->json([
            'data' => $systems
        ], 200);
    }

    public function store(Request $request)
    {
        $system = new System;
        $system->name = $request->name;
        $system->state = 'ACTIVO';
        $system->save();

        return response()->json([
            'data' => $system
        ], 201);
    }

    public function show($id)
    {
        $system = System::find($id);
        
        if($system) {
            return response()->json([
                'data' => $system
            ], 200);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }   
    }

    public function update(Request $request, $id)
    {
        $system = System::find($id);
        if($system) {
            $system->name = $request->name;
            $system->save();

            return response()->json([
                'data' => $system
            ], 201);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $system = System::find($id);
        if($system) {
            $system->state = 'INACTIVO';
            $system->save();

            return response()->json([
                'data' => $system
            ], 201);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }
    }
}