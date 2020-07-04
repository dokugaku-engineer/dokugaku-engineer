<?php

namespace App\Http\Resources\Post;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryPost\CategoryPost as CategoryPostResource;

class Post extends JsonResource
{
    /**
     * リソースを配列へ変換
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'content' => $this->content,
            'parent' => $this->parent,
            'status' => $this->status,
            'categoryPost' => new CategoryPostResource($this->categoryPost),
            'deleted_at' => DateHelper::getTimestamp($this->deleted_at),
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }
}
