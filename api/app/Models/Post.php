<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * 複数代入しない属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 投稿に紐づく CategoryPost を取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoryPost()
    {
        return $this->hasOne('App\Models\CategoryPost');
    }

    /**
     * 公開する
     *
     * @return void
     */
    public function publish(): void
    {
        $this->status = 'publish';
        $this->save();
    }

    /**
     * 非公開にする
     *
     * @return void
     */
    public function unpublish(): void
    {
        $this->status = 'private';
        $this->save();
    }
}
