<?php

namespace App\Services\Admin\Post;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdatePost
{
    /**
     * Create an post.
     *
     * @param  array $inputs
     * @return Post|\Illuminate\Http\RedirectResponse
     */
    public function execute(array $inputs, Post $post)
    {
        DB::beginTransaction();

        try {
            $post->update($inputs['posts']);
            $post->categoryPost()->update($inputs['category_posts']);
        } catch (Exception $e) {
            DB::rollback();

            return back()->withInput();
        }

        DB::commit();

        return $post;
    }
}
