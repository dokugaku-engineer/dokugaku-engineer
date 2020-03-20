<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['id'];

    public function taking_courses()
    {
        return $this->hasMany('App\Models\TakingCourse');
    }
}
