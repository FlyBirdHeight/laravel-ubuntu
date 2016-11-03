<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function discussion(){
        return $this->belongsToMany(Discussion::class);
    }
}
