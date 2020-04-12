<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function parts()
    {
        return $this->hasMany('App\Models\Part');
    }

    public function taking_courses()
    {
        return $this->hasMany('App\Models\TakingCourse');
    }

    public function withCourses()
    {
        return $this->load('parts.lessons.lectures');
    }
}
