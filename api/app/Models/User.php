<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function taking_courses()
    {
        return $this->hasMany('App\Models\TakingCourse');
    }

    public function learning_histories()
    {
        return $this->hasMany('App\Models\LearningHistory');
    }
}
