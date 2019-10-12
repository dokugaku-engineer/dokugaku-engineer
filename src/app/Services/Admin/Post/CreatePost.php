<?php

namespace App\Services\Admin\Post;

use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\CategoryPost;

class CreatePost
{
  /**
   * Create an post.
   *
   * @param array $inputs
   * @return Post
   */
  public function execute(array $inputs): Post
  {
    DB::beginTransaction();

    try {
      $post = new Post($inputs['posts']);
      $post->save();

      $category_post = new CategoryPost($inputs['category_posts']);
      $post->category_post()->save($category_post);
    } catch (Exception $e) {
      DB::rollback();
      return back()->withInput();
    }

    DB::commit();

    return $post;
  }
}
