<?php

namespace App\Http\Resources\Part;

use App\Http\Resources\Lesson\LessonWithLecture as LessonWithLectureResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PartWitrhLecture extends JsonResource
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
            'order' => $this->order,
            'name' => $this->name,
            'description' => $this->description,
            'lessons' => LessonWithLectureResource::collection($this->lessons),
        ];
    }
}
