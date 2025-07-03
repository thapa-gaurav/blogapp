<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index($user)
    {
        $posts = Post::where('user_id', $user)
            ->withcount(['like', 'comment'])
            ->with(['user', 'like.user:id,username', 'comment.user:id,username'])
            ->simplePaginate(3);
        return view('user.index', compact('posts'));
    }

    public function showLikedPosts($user)
    {
        $posts = Post::whereHas('like', function ($query) use ($user) {
            $query->where('user_id', $user);
        })
            ->withcount(['like', 'comment'])
            ->with(['user', 'like.user:id,username', 'comment.user:id,username'])
            ->simplePaginate(3);

        return view('user.index', compact('posts'));

    }

    public function showCommentedPosts($user)
    {
        $posts = Post::whereHas('comment', function ($query) use ($user) {
            $query->where('user_id', $user);
        })
            ->withcount(['like', 'comment'])
            ->with(['user', 'like.user:id,username', 'comment.user:id,username'])
            ->simplePaginate(3);

        return view('user.index', compact('posts'));
    }
}
