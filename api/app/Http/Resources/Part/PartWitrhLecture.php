<?php

namespace App\Http\Resources\Part;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Lesson\LessonWithLecture as LessonWithLectureResource;

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
            'lessons' => LessonWithLectureResource::collection($this->lessons)
        ];
    }
}
