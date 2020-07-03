<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use App\Services\Admin\Post\CreatePost;
use App\Services\Admin\Post\UpdatePost;

/**
 * 使用していないクラス
 */
class PostController extends Controller
{
    /**
     * View を返す
     *
     * @return string
     */
    public function index(): string
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * View を返す
     *
     * @return string
     */
    public function create(): string
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.create')->with([
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    /**
     * データを保存してリダイレクトする
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        app()->make(CreatePost::class)->execute($validated);
        return redirect()->route('admin.posts.index');
    }

    /**
     * View を返す
     *
     * @return string
     */
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

    /**
     * Post を保存してリダイレクトする
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        $validated = $request->validated();
        app()->make(UpdatePost::class)->execute($validated, $post);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Post を削除してリダイレクトする
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    /**
     * 公開にしてリダイレクトする
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish(Post $post)
    {
        $post->publish();
        return redirect()->route('admin.posts.index');
    }

    /**
     * 非公開にしてリダイレクトする
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unpublish(Post $post)
    {
        $post->unpublish();
        return redirect()->route('admin.posts.index');
    }
}
