<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningHistory extends Model
{
    /**
     * 複数代入しない属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 受講履歴に紐付いたレクチャーを取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture');
    }

    /**
     * 受講履歴に紐付いたユーザーを取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
