<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'public' => 1,
        'locked' => 0,
        'premium' => 0,
    ];
}
