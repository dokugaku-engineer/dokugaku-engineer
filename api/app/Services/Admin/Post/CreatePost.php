<?php

namespace App\Services\Admin\Post;

use App\Models\CategoryPost;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;

class CreatePost
{
    /**
     * Create an post.
     *
     * @param  array $inputs
     * @return Post|\Illuminate\Http\RedirectResponse
     */
    public function execute(array $inputs)
    {
        DB::beginTransaction();

        try {
            $post = new Post($inputs['posts']);
            $post->status = 'private';
            $post->save();

            $categoryPost = new CategoryPost($inputs['category_posts']);
            $post->categoryPost()->save($categoryPost);
        } catch (Exception $e) {
            DB::rollback();

            return back()->withInput();
        }

        DB::commit();

        return $post;
    }
}
