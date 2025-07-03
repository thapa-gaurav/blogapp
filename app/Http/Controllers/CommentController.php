<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Notifications\UserComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:500']
        ]);
        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'comment' => $request->comment,
        ]);

        if($post->id != Auth::id()){
//            $user = $post->user;
            $user = User::find($post->user->id);
            $user->notify(new UserComment(Auth::user()->username));

        }
        return back()->with('success','comment added!');
    }

    public  function markAsRead($id)
    {
        auth()->user()->notifications->where('id',$id)->markAsRead();
        return back();
    }
}
