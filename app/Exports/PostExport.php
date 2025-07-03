<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;

class PostExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Post::all();
    }

    public function view()
    {
        $post = Post::select('post_text','caption','post_image')->all();
        return view('export.document', compact('post'));
}
}
