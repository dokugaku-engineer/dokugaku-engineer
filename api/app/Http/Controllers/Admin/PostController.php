<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use App\Services\Admin\Post\CreatePost;
use App\Services\Admin\Post\UpdatePost;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
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

    public function edit(Post $post)
    {
        // Postを全記事取得する際に、親記事に自身が表示させないように除外する
        $posts = Post::with('category_post')->get()->reject(function ($item) use (&$post) {
            return $item['id'] === $post->id;
        });
        $categories = Category::all();
        return view('admin.posts.edit')->with([
            'post' => $post,
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $validated = $request->validated();
        app()->make(UpdatePost::class)->execute($validated, $post);
        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    public function publish(Post $post)
    {
        $post->publish();
        return redirect()->route('admin.posts.index');
    }

    public function unpublish(Post $post)
    {
        $post->unpublish();
        return redirect()->route('admin.posts.index');
    }
}
