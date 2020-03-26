<?php

namespace App\Http\Resources\LearningHistory;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class LearningHistory extends JsonResource
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
            'user_id' => $this->user_id,
            'lecture_id' => $this->lecture_id,
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }
}
