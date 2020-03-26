<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TakingCourse extends Model
{
    protected $guarded = ['id'];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function doesntExist($user_id, $course_id)
    {
        return TakingCourse::where([['user_id', $user_id], ['course_id', $course_id]])->doesntExist();
    }
}
