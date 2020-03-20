<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningHistory extends Model
{
    protected $guarded = ['id'];

    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
