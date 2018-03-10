<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoalFollower extends Model
{
    protected $table = 'goal_followers';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'goal_id', 
    ];
}
