<?php

namespace App\Http\Resources\Lesson;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class Lesson extends JsonResource
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
            'part_id' => $this->part_id,
            'order' => $this->order,
            'name' => $this->name,
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }
}
