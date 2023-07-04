<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
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
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|min:8',
        ]);

        $validate['password'] = bcrypt($validate['password']);

        if ($user = User::create($validate)) {
            Cache::forget('users');
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user,
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'User failed to create',
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if (Cache::has('users')) {
            return response()->json([
                'success' => true,
                'message' => 'User retrieved successfully',
                'data' => Cache::get('users'),
            ]);
        }

        $users = User::all();
        Cache::put('users', $users);
        return response()->json([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data' => $users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Cache::forget('users');
        return response()->json([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'email' => 'nullable|string',
            'name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:8',
        ]);


        if ($request->filled('email') && $user->email !== $request->email) {
            $checkEmail = User::where('email', $request->email)->first();

            if ($checkEmail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email already exists',
                ], 400);
            }
        }

        if ($request->filled('password')) {
            $validate['password'] = bcrypt($validate['password']);
        }

        if ($user->update($validate)) {
            Cache::forget('users');
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User failed to update',
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            Cache::forget('users');
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User failed to delete',
        ], 400);
    }
}
