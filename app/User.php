<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','avatar','realname','web','phone','confirm_code','discuss'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function discussions(){
        return $this->hasMany(Discussion::class);//$user->discussions,可以拿到user发布的所有帖子
    }

    public function comments(){
        return $this->hasMany(Comment::class);//$user->comments,可以拿到user发布的评论
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role){
        if (is_string($role)){
            return $this->roles->contain('name',$role);//判断name中是否存在这个role比如admin
        }
        return !! $role->intersect($this->roles)->count();//intersect用来判断前面和后面是否存在相同的
    }

    public function article(){
        return $this->hasMany(Article::class);
    }

    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }

    public function favourites(){
        return $this->belongsToMany(Discussion::class,'favourites')->withTimestamps();
    }

}
