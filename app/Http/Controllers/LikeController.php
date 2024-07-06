<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function __invoke(Blog $blog, Request $request)
    {
        if ($blog->hasBeenLiked()) {
            $blog->decrement('likes_count');
            $message = "You have successfully un-liked the blog!";
        }
        else{
            $blog->increment('likes_count');
            $message = "You have successfully liked the blog!";
        }
        auth()->user()->likes()->toggle($blog->id);
        return back()->with('message', $message);
    }
}
