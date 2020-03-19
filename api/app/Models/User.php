<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['id'];

    public function course_users()
    {
        return $this->hasMany('App\Models\CourseUser');
    }
}
