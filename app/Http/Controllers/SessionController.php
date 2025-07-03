<?php

namespace App\Http\Controllers;

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
            throw ValidationException::withMessages([
                'username' => 'Incorrect Credentials',
            ]);
        }
        $request->session()->regenerate();
        return redirect()->route('post-index');

    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('post-index');
    }
}
