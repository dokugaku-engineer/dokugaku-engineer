<?php

namespace App\Http\Resources\Lecture;

use Illuminate\Http\Resources\Json\JsonResource;

class LectureWithLearned extends JsonResource
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
            'lesson_id' => $this->lesson_id,
            'name' => $this->name,
            'video_url' => $this->video_url,
            'description' => $this->description,
            'slug' => $this->slug,
            'prev_lecture_slug' => $this->prev_lecture_slug,
            'next_lecture_slug' => $this->next_lecture_slug,
            'locked' => $this->locked,
            'premium' => $this->premium,
            'learned' => !$this->learningHistories->isEmpty()
        ];
    }
}
