<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['title','body','user_id','last_user_id'];

    public function user(){
        return $this->belongsTo(User::class);//discussion->user,通过discussion拿到user
    }

    public function comments(){
        return $this->hasMany(Comment::class);//$discussions->comments,可以拿到discussion的评论
    }
    
}
