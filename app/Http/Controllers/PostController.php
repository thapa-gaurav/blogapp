<?php

namespace App\Http\Controllers;

use App\Exports\PostExport;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::withcount(['like', 'comment'])
            ->with(['user', 'like.user:id,username', 'comment.user:id,username'])
            ->latest()
            ->simplePaginate(3);
        return new UserCollection($posts);
    }

    public function show($postID)
    {
        $post = Post::withcount(['like', 'comment'])
            ->with(['like.user:id,username', 'comment.user:id,username', 'user'])
            ->findOrFail($postID);
        return new UserResource($post);
    }

    public function create()
    {
        return view('post.create');
    }


    public function store(Request $request)
    {
//        if (!Auth::user()) {
//            return redirect()->route('login');
//        }
        $request->validate([
            'caption' => ['required'],
            'post_text' => ['required'],
            'post_image' => ['required', 'image', 'mimes:jpg,png,jpeg'],
            'price' => ['required']
        ]);

        $imageName = $request->file('post_image')->store('images', 'public');
        return Post::create([
            'caption' => $request->caption,
            'post_text' => $request->post_text,
            'post_image' => $imageName,
            'user_id' => rand(1, 1000000),
            'price' => $request->price
        ]);

    }

    public function destroy($postID)
    {
        $post = Post::findOrFail($postID);
        $imagePath = $post->post_image;
        Storage::disk('public')->delete($imagePath);
        $post->delete();
        return response()->json("Deletion Success");
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update($postID, Request $request)
    {
        
        $request->validate([
            'caption' => ['required'],
            'post_text' => ['required'],
            'post_image' => ['required', 'image', 'mimes:jpg,png,jpeg'],
            'price' => ['required']
        ]);
        $post = Post::findOrFail($postID);
        $previousImagePath = $post->post_image;
        $imageName = $request->hasFile('post_image') ?
            $request->file('post_image')->store('images', 'public') : null;

        $post->update([
            'caption' => $request->caption,
            'post_text' => $request->post_text,
            'post_image' => $imageName,
            'price' => $request->price

        ]);
        Storage::disk('public')->delete($previousImagePath);
        return response()->json([
            'success' => true,
            'message' => 'Update successful',
            'data' => $post
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return Post::where('caption', 'like', "%$search%")
            ->withcount(['like', 'comment'])
            ->with(['user', 'like.user:id,username', 'comment.user:id,username'])
            ->latest()
            ->simplePaginate(3);
//        dd($posts);

    }

    public function exportExcel()
    {
        return Excel::download(new PostExport, 'post.xlsx');
    }

    public function exportPdf()
    {
        $posts = Post::get();
        $pdf = Pdf::loadView('export.document', compact('posts'));
        return $pdf->download('test.file');
    }

    public function exportCsv()
    {
        return Excel::download(new PostExport, 'post.csv');
    }

}
