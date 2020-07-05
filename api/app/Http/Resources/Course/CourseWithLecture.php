<?php

namespace App\Http\Resources\Course;

use App\Http\Resources\Part\PartWitrhLecture as PartWitrhLectureResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseWithLecture extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'parts' => PartWitrhLectureResource::collection($this->parts),
        ];
    }
}
