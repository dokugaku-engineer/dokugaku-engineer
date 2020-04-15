<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $attributes = [
        'public' => 1,
        'locked' => 0,
        'premium' => 0,
    ];

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }

    public function learning_histories()
    {
        return $this->hasMany('App\Models\LearningHistory');
    }

    public function load_learning_histories($user_id, $course_id)
    {
        return $this->load(['learning_histories' => function ($query) use ($user_id, $course_id) {
            $query->where('learning_histories.user_id', $user_id)->where('course_id', $course_id);
        }]);
    }
}
