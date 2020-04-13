<?php

namespace App\Http\Resources\Lesson;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Lecture\MinimumLecture as MinimumLectureResource;

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
            'lectures' => MinimumLectureResource::collection($this->lectures)
        ];
    }
}
