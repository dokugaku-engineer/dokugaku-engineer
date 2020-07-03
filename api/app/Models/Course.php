<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * 複数代入しない属性
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * コースに属するパートを取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parts()
    {
        return $this->hasMany('App\Models\Part');
    }

    /**
     * コースに紐づく受講コースを取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taking_courses()
    {
        return $this->hasMany('App\Models\TakingCourse');
    }
}
