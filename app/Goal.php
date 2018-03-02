<?php

namespace App;

use App\User;
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
    
    public function users()
    {
        return $this->belongsTo('User', 'id');
    }

    public function goals(){
        return $this->hasMany(Comment::class);
    }

    public function addComment($body){
        $this->comments()->create(compact('body'));
    }
}
