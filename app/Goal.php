<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'target_date', 'is_private', 'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo('User');
    }

    public function goals(){
        return $this->hasMany(Comment::class);
    }

    public function addComment($body){
        $this->comments()->create(compact('body'));
    }
}
