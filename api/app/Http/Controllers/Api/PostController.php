<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\Post\Post as PostResource;
use App\Services\Admin\Post\CreatePost;

/**
 * @group 2. Post
 */
class PostController extends Controller
{
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
}
