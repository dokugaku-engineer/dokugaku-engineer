<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function category_post()
    {
        return $this->hasOne('App\Models\CategoryPost');
    }
}
