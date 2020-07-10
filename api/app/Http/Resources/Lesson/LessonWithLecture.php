<?php

namespace App\Http\Resources\Lesson;

use App\Http\Resources\Lecture\MinimumLecture as MinimumLectureResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonWithLecture extends JsonResource
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
            'lectures' => MinimumLectureResource::collection($this->lectures),
        ];
    }
}
