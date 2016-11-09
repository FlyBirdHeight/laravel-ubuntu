<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    public function user(){
        $this->hasMany(User::class);
    }
}
