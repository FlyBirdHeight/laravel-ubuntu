<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','body','user_id','last_user_id','created_at'];

    public function getCreatedAtAttribute($date)
    {
        if (Carbon::now() < Carbon::parse($date)->addDays(10)) {
            return Carbon::parse($date)->diffForHumans();
        }

        return Carbon::parse($date);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function comments(){
        return $this->hasMany(Articlecomment::class);//$article->comments,可以拿到article的评论
    }
    
    public function getTagListAttribute(){
        return $this->tags->lists('id')->all();//监听视图文件中是否有taglist这个字段
    }
}
