<?php

namespace App\Http\Resources\User;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
            'stripe_id' => $this->stripe_id,
        ];
    }
}
