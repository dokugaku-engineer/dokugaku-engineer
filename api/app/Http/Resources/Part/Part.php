<?php

namespace App\Http\Resources\Part;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Lesson\Lesson as LessonResource;

class Part extends JsonResource
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
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
            'lessons' => LessonResource::collection($this->lessons)
        ];
    }
}
