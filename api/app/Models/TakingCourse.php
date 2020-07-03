<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TakingCourse extends Model
{
    /**
     * 複数代入しない属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 受講コースに紐づくコースを取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    /**
     * 受講コースに紐づくユーザーを取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * パートの親のコースを取得
     *
     * @param int $user_id
     * @param int $course_id
     * @return bool
     */
    public static function doesntExist(int $user_id, int $course_id): bool
    {
        return TakingCourse::where([['user_id', $user_id], ['course_id', $course_id]])->doesntExist();
    }
}
