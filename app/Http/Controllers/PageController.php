<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function posts()
    {
        return view('posts',[
            'posts' => Post::with('user')->latest()->paginate(5),// getall from user order by  desc, use pagination
        ]);
    }

    public function post(Post $post)
    {
        return view('post', ['post' => $post]);
    }
}
