<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }
}
