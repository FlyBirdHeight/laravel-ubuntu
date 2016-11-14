<?php

namespace App\Providers;

use App\User;
use App\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
//        $this->registerPolicies($gate);
//        foreach ($this->getPermission() as $permission){
//            $gate->define($permission->name,function (User $user) use ($permission){
//                return $user->hasRole($permission->roles);
//            });
//        }
        //用来判断当前文章是否是当前用户来创建，$user指的是当前登陆的用户
        //define中的字符串完全可以进行自定义
    }
    
//    protected function getPermission(){
//        return Permission::with('roles')->get();//把permission拿到，然后把我们定义的roles也拿到
//    }
}
