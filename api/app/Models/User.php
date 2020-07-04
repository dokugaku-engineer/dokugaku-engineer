<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    /**
     * 複数代入しない属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * ユーザーの受講コースを取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function takingCourses()
    {
        return $this->hasMany('App\Models\TakingCourse');
    }

    /**
     * ユーザーの受講履歴を取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function learningHistories()
    {
        return $this->hasMany('App\Models\LearningHistory');
    }
}
