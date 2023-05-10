<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PostRequest;
use App\Http\Resources\Post\Post as PostResource;
use App\Models\Post;
use App\Services\Admin\Post\CreatePost;
use App\Services\Admin\Post\UpdatePost;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

/**
 * @group 1. Posts
 */
class PostController extends ApiController
{
    /**
     * 記事一覧を取得
     *
     * @queryParam except Category id to except
     *
     * @responsefile responses/post.index.json
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $posts = Post::all();

        // 除外指定されたIDを除外する
        $exceptId = (int) $request->input('except');
        if ($exceptId) {
            $posts = $posts->reject(function ($item) use (&$exceptId) {
                return $item->id === $exceptId;
            });
        }

        return PostResource::collection($posts);
    }

    /**
     * 記事を保存
     *
     * @bodyParam posts[slug] string required Post slug. Example: web
     * @bodyParam posts[title] string required Post title. Example: Webの基本
     * @bodyParam posts[content] string required Post content. Example: Webの基本はTCP/IPです。
     * @bodyParam posts[parent] int Post parant ID. Example: 12
     * @bodyParam category_posts[category_id] int CategoryPost ID. Example: 1
     *
     * @responsefile responses/post.store.json
     *
     * @param  PostRequest $request
     * @return PostResource|\Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        try {
            $validated = $request->validated();
            $post = app()->make(CreatePost::class)->execute($validated);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new PostResource($post);
    }

    /**
     * 記事を取得
     *
     * @bodyParam id int required Post id. Example: 13
     *
     * @responsefile responses/post.store.json
     *
     * @param  int $id
     * @return PostResource
     */
    public function show(int $id)
    {
        $post = Post::with('categoryPost')->find($id);

        return new PostResource($post);
    }

    /**
     * カテゴリーを更新
     *
     * @bodyParam id int required Post id. Example: 1
     * @bodyParam posts[slug] string required Post slug. Example: web
     * @bodyParam posts[title] string required Post title. Example: Webの基本
     * @bodyParam posts[content] string required Post content. Example: Webの基本はTCP/IPです。
     * @bodyParam posts[parent] int Post parant ID. Example: 12
     * @bodyParam category_posts[category_id] int CategoryPost ID. Example: 1
     *
     * @responsefile responses/post.store.json
     *
     * @param  PostRequest $request
     * @param  Post        $post
     * @return PostResource|\Illuminate\Http\JsonResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        try {
            $validated = $request->validated();
            $post = app()->make(UpdatePost::class)->execute($validated, $post);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new PostResource($post);
    }

    /**
     * 記事を削除
     *
     * @bodyParam id int required Post id. Example: 1
     *
     * @responsefile responses/post.store.json
     *
     * @param  Post $post
     * @return PostResource
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return new PostResource($post);
    }

    /**
     * 記事を公開
     *
     * @bodyParam id int required Post id. Example: 1
     *
     * @responsefile responses/post.store.json
     *
     * @param  Post $post
     * @return PostResource
     */
    public function publish(Post $post)
    {
        $post->publish();

        return new PostResource($post);
    }

    /**
     * 記事を非公開
     *
     * @bodyParam id int required Post id. Example: 1
     *
     * @responsefile responses/post.store.json
     *
     * @param  Post $post
     * @return PostResource
     */
    public function unpublish(Post $post)
    {
        $post->unpublish();

        return new PostResource($post);
    }
}
