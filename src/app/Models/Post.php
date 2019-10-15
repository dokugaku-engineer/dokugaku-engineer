<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function category_post()
    {
        return $this->hasOne('App\Models\CategoryPost');
    }

    public function publish()
    {
        $this->status = 'publish';
        $this->save();
    }

    public function unpublish()
    {
        $this->status = 'private';
        $this->save();
    }
}
