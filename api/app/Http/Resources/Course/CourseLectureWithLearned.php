<?php

namespace App\Http\Resources\Course;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Part\PartWithLearned as PartWithLearnedResource;

class CourseLectureWithLearned extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
            'parts' => PartWithLearnedResource::collection($this->parts)
        ];
    }
}
