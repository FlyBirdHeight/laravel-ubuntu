<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name','color'];
    public function discussion(){
        return $this->belongsToMany(Discussion::class);
    }

    public function article(){
        return $this->belongsToMany(Article::class);
    }
}
