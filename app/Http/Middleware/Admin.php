<?php

namespace App\Http\Middleware;

use App\Discussion;
use App\Role;
use Closure;
use Flashy;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()) {
            if (count($request->user()->roles)==0){
                Flashy::error('对不起，你没有管理员权限!', 'http://adsionli.top');
                return redirect('/');
            }else{
                foreach ($request->user()->roles as $role){
                    if ($role->label == "Admin"){
                        return $next($request);
                    }
                }
                Flashy::error('对不起，你没有管理员权限!', 'http://adsionli.top');
                return redirect('/');
            }
        }
        else {
            Flashy::error('对不起，你还未登录!', 'http://adsionli.top');
            return view('users.login');
        }
    }
}
