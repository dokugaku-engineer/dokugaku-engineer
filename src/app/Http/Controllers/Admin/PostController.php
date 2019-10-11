<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

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

        DB::beginTransaction();

        try {
            $post = new Post($request->input('posts', []));
            $post->save();
            $post->category_post()->create($request->input('category_post', []));
        } catch(Exception $e) {
            DB::rollback();
            return back()->withInput();
        }

        DB::commit();

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
    {

    }

    public function unpublish()
    {
        
    }
}
