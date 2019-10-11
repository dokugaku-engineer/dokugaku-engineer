<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{

    protected $guarded = ['id'];
    
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
