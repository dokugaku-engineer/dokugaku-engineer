<?php

namespace App\Http\Resources\Lecture;

use App\Helpers\DateHelper;
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
            'lesson_id' => $this->lesson_id,
            'order' => $this->order,
            'name' => $this->name,
            'video_url' => $this->video_url,
            'description' => $this->description,
            'slug' => $this->slug,
            'prev_lecture_slug' => $this->prev_lecture_slug,
            'next_lecture_slug' => $this->next_lecture_slug,
            'public' => $this->public,
            'locked' => $this->locked,
            'premium' => $this->premium,
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
            'learned' => !$this->learning_histories->isEmpty()
        ];
    }
}
