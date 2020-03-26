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

    public function withCourses($user_id)
    {
        return $this->load([
            'parts.lessons.lectures' => function ($query) {
                $query->where('lectures.public', 1);
            },
            'parts.lessons.lectures.learning_histories' => function ($query) use ($user_id) {
                $query->where('learning_histories.user_id', $user_id);
            }
        ]);
    }
}
