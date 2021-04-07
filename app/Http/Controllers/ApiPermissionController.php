<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class ApiPermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::where('state', 'ACTIVO')->get();
       
        return response()->json([
            'data' => $permissions
        ], 200);
    }

    public function store(Request $request)
    {
        $permission = new Permission;
        $permission->user_id = $request->user_id;
        $permission->system_id = $request->system_id;
        $permission->profile_id = $request->profile_id;
        $permission->state = 'ACTIVO';
        $permission->save();

        return response()->json([
            'data' => $permission
        ], 201);
    }

    public function show($id)
    {
        $permission = Permission::find($id);
        
        if($permission) {
            return response()->json([
                'data' => $permission
            ], 200);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }   
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        if($permission) {
            $permission->user_id = $request->user_id;
            $permission->system_id = $request->system_id;
            $permission->profile_id = $request->profile_id;
            $permission->save();

            return response()->json([
                'data' => $permission
            ], 201);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        if($permission) {
            $permission->state = 'INACTIVO';
            $permission->save();

            return response()->json([
                'data' => $permission
            ], 201);
        } else {
            return response()->json([
                'error' => 'data not found'
            ], 404);
        }
    }
}
