<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit(Request $request)
    {
        return view('password.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required'],
        ]);
        if (Hash::check($request->current_password, $request->user()->getAuthPassword())) {
            $request->user()->fill([
                'password' => Hash::make($request->new_password),
            ])->save();
        }else{
            return response()->json([
                "message"=>"password not match",
            ]);
        }
//        return redirect('/user/'.Auth::user()->id)->with('success','Password Changed');
        return response()->json([
            'message'=>"Password changed successfully",
        ]);
    }
}
