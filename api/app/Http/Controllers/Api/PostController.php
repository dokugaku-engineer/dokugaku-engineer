<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\PostRequest;
use App\Http\Resources\Post\Post as PostResource;
use App\Models\Post;
use App\Services\Admin\Post\CreatePost;
use App\Services\Admin\Post\UpdatePost;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

/**
 * @group 2. Post
 */
class PostController extends ApiController
{
    /**
     * 記事一覧を取得
     *
     * @queryParam except Category id to except
     * @responsefile responses/post.index.json
     *
     * @return PostResourceCollection
     *
     */
    public function index(Request $request)
    {
        $posts = Post::all();

        // 除外指定されたIDを除外する
        $except_id = (int) $request->input('except');
        if ($except_id) {
            $posts = $posts->reject(function ($item) use (&$except_id) {
                return $item->id === $except_id;
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
     * @param PostRequest $request
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
     * @param int $id
     * @return PostResource
     */
    public function show(int $id)
    {
        $post = Post::with('category_post')->find($id);
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
     * @param PostRequest $request
     * @param Post $post
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
     * @param Post $post
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
     * @param Post $post
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
     * @param Post $post
     * @return PostResource
     */
    public function unpublish(Post $post)
    {
        $post->unpublish();
        return new PostResource($post);
    }
}
