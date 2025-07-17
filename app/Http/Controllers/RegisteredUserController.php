<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
            $attributes = $request->validate([
               'name' => ['required'],
               'email' => ['required'],
               'username' => ['required'],
               'password' => ['required']
            ]);
            $user = User::create($attributes);
            return response()->json([
                "message"=>"successFully registered.",
                "data"=>$user
            ]);
    }
}
