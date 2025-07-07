<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalUserWithPost = User::has('posts')->count();
        $totalPost = Post::count();
        $newUserToday = User::whereDate('created_at',today())->count();
        $newPostToday = Post::whereDate('created_at',today())->count();
        return view("stat.index",compact('totalPost','totalUser','totalUserWithPost','newPostToday','newUserToday'));
    }
}
