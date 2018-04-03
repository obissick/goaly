<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoalLike extends Model
{
    protected $table = 'goal_likes';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'goal_id', 
    ];
}
