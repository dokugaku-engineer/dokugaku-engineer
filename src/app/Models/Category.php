<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];
    
    protected $attributes = [
        'parent' => 0,
    ];
}
