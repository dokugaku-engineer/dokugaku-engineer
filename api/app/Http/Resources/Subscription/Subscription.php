<?php

namespace App\Http\Resources\Subscription;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class Subscription extends JsonResource
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
            'name' => $this->name,
            'stripe_id' => $this->stripe_id,
            'stripe_status' => $this->stripe_status,
            'stripe_plan' => $this->stripe_plan,
            'quantity' => $this->quantity,
            'ends_at' => $this->ends_at,
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }
}
