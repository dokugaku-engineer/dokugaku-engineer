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
    public function learningHistories()
    {
        return $this->hasMany('App\Models\LearningHistory');
    }

    /**
     * レクチャーに紐づく受講履歴をロードする
     *
     * @param int $userId
     * @param int $courseId
     * @return $this
     */
    public function loadLearningHistories(int $userId, int $courseId)
    {
        return $this->load(['learningHistories' => function ($query) use ($userId, $courseId) {
            $query->where('learning_histories.user_id', $userId)->where('course_id', $courseId);
        }]);
    }
}
