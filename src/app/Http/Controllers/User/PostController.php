<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        # TODO: pagenation
        $posts = Post::orderBy('created_at', 'asc')->get();

        return view('users.posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(string $postSlug)
    {
        $post = Post::where('slug', $postSlug)->first();

        return view('users.posts.show', [
            'post' => $post,
            'category' => 'web'
        ]);
    }
}
