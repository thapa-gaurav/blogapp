<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        Like::create([
            'user_id'=> Auth::id(),
            'post_id'=> $post->id,
        ]);
//        return redirect('/posts');
        return back();
    }

    public function destroy(Post $post)
    {
//        $likeID = Like::where('likes_user_id_post_id_unique',Auth::id().$post->id);
        $like = Like::where('user_id',Auth::id())
            ->where('post_id',$post->id)
            ->first();
        $like->delete();
        return back();
    }

}
