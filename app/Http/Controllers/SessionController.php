<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($attributes)) {
            return response()->json([
                "message" => "The provided credentials are incorrect",
            ], 401);
        }
        $user = User::where('username', $request->username)->first();
        $token = $user->createToken('Token for user ' . $user->username)->plainTextToken;
        return response()->json(['Token' => $token], 200);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'You have been successfully logged out.'
        ], 200);
    }
}
