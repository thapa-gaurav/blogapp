<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function download(){
        $posts = Post::get();
        $pdf = Pdf::loadView('pdf.document',compact('posts'));
        return $pdf->download('test.file');
    }
}
