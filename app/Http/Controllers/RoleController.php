<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
        ]);

        if (Role::create($validate)) {
            Cache::forget('roles');
            return response()->json([
                'success' => true,
                'message' => 'Role created successfully',
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Role creation failed',
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if (Cache::has('roles')) {
            return response()->json([
                'success' => true,
                'message' => 'User retrieved successfully',
                'data' => Cache::get('users'),
            ]);
        }

        $roles = Role::all();
        Cache::put('roles', $roles);
        return response()->json([
            'success' => true,
            'message' => 'Role retrieved successfully',
            'data' => Role::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        Cache::forget('roles');
        return response()->json([
            'success' => true,
            'message' => 'Role retrieved successfully',
            'data' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validate = $request->validate([
            'name' => 'required|string',
        ]);

        if ($role->update($validate)) {
            Cache::forget('roles');
            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Role update failed',
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            DB::beginTransaction();
            User::where('role_id', $role->id)->delete();
            $role->delete();
            DB::commit();

            Cache::forget('roles');

            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Role delete failed',
            ], 400);
        }
    }
}
