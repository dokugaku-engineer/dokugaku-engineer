<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];

    public function part()
    {
        return $this->belongsTo('App\Models\Part');
    }

    public function lectures()
    {
        return $this->hasMany('App\Models\Lecture');
    }
}
