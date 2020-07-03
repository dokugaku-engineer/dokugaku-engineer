<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * 複数代入しない属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 属性に対するモデルのデフォルト値
     *
     * @var array
     */
    protected $attributes = [
        'parent' => 0,
    ];

    /**
     * カテゴリーに紐づく CategoryPost を取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category_post()
    {
        return $this->hasOne('App\Models\CategoryPost');
    }
}
