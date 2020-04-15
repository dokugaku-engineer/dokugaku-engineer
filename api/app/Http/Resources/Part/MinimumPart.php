<?php

namespace App\Http\Resources\Part;

use Illuminate\Http\Resources\Json\JsonResource;

class MinimumPart extends JsonResource
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
            'course_id' => $this->course_id,
            'order' => $this->order,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
