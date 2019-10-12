<?php

namespace App\Services\Admin\Post;

use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\CategoryPost;

class UpdatePost
{
  /**
   * Create an post.
   *
   * @param array $inputs
   * @return Post
   */
  public function execute(array $inputs, Post $post): Post
  {
    DB::beginTransaction();

    try {
      $post->update($inputs['posts']);
      $post->category_post()->update($inputs['category_posts']);
    } catch (Exception $e) {
      DB::rollback();
      return back()->withInput();
    }

    DB::commit();

    return $post;
  }
}
