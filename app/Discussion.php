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

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function getTagListAttribute(){
        return $this->tags->lists('id')->all();//监听视图文件中是否有taglist这个字段
    }
    
}
