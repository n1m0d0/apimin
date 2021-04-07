<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;

class ApiInstitutionController extends Controller
{

    public function index()
    {
        $institutions = Institution::where('state', 'ACTIVO')->get();
       
        return response()->json([
            'data' => $institutions
        ], 200);
    }

    public function store(Request $request)
    {
        $institution = new Institution;
        $institution->name = $request->name;
        $institution->state = 'ACTIVO';
        $institution->save();

        return response()->json([
            'data' => $institution
        ], 201);
    }

    public function show($id)
    {
        $institution = Institution::find($id);
        
        if($institution) {
            return response()->json([
                'data' => $institution
            ], 200);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }   
    }

    public function update(Request $request, $id)
    {
        $institution = Institution::find($id);
        if($institution) {
            $institution->name = $request->name;
            $institution->save();

            return response()->json([
                'data' => $institution
            ], 201);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $institution = Institution::find($id);
        if($institution) {
            $institution->state = 'INACTIVO';
            $institution->save();

            return response()->json([
                'data' => $institution
            ], 201);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }
    }
}