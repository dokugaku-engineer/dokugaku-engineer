<?php

namespace App\Http\Resources\Lecture;

use Illuminate\Http\Resources\Json\JsonResource;

class MinimumLecture extends JsonResource
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
            'order' => $this->order,
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }
}
