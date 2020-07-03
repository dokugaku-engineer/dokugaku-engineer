<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use SoftDeletes;

    /**
     * 複数代入しない属性
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * 属性に対するモデルのデフォルト値
     *
     * @var array
     */
    protected $attributes = [
        'public' => 1,
        'locked' => 0,
        'premium' => 0,
    ];

    /**
     * レクチャーの親のレッスンを取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }

    /**
     * レクチャーに紐づく受講履歴を取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function learning_histories()
    {
        return $this->hasMany('App\Models\LearningHistory');
    }

    /**
     * レクチャーに紐づく受講履歴をロードする
     *
     * @param int $user_id
     * @param int $course_id
     * @return $this
     */
    public function load_learning_histories(int $user_id, int $course_id)
    {
        return $this->load(['learning_histories' => function ($query) use ($user_id, $course_id) {
            $query->where('learning_histories.user_id', $user_id)->where('course_id', $course_id);
        }]);
    }
}
