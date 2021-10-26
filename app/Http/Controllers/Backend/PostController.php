<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //save
        $post = Post::create(
            [
            'user_id' => auth()->user()->id,
            ] +
            $request->all()
        );
        //validate fields
        /*
        $request->validate([
            'title'=>'required|min:3|max:40',
            'file' =>'image|mimes:jpg,jpeg,gif,png,svg|max:2048',
            'body' =>'required'
            //'iframe'=>'required'
        ]);
        */
        //image
        if ($request->file('file')) {
            //save image in folder public/posts and link to post->image
            $imagenes= $request->file('file')->store('posts','public');
            $post->image = $imagenes;
            $post->save();
        }
        //return to last view with session variable status
        return back()->with('status','Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        //update post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'iframe' => $request->iframe,
        ]);
        //delete image
        if ($request->file('file')) {
            //delete image from public
            Storage::disk('public')->delete($post->image);
            //save image in folder public/posts and link to post->image
            $imagenes= $request->file('file')->store('posts','public');
            $post->image = $imagenes;
            $post->save();
        }
        //return to last view with session variable status
        return back()->with('status','Post edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //delete image from public
        Storage::disk('public')->delete($post->image);
        //delete post
        $post->delete();
        //return preview request with status sucefully
        return back()->with('status','Post deleted');
    }
}
