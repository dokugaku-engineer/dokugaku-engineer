<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use App\Services\Admin\Post\CreatePost;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact($posts));
    }

    public function create()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.create')->with([
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        app()->make(CreatePost::class)->execute($validated);
        return redirect()->route('admin.posts.index');
    }

    public function edit()
    {
        # code...
    }

    public function update()
    {
        # code...
    }

    public function delete()
    { }

    public function unpublish()
    { }
}
