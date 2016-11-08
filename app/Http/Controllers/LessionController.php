<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Transform\LessonTransformer;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class LessionController extends ApiController
{
    protected $userTransformer;


    public function __construct(LessonTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
        $this->middleware('auth.basic');
    }

    //all()这个方法是不好的（）
    //无法添加额外的信息，无提示信息(Response::json来添加额外的信息,ok)
    //直接展示我们的数据结构（使用字段映射来解决）
    //显示我们的错误提示，没有错误信息
    public function index(){
        $user = User::all();
        return $this->response([
            'status'=>'success',
            'data'=>$this->userTransformer->transformCollection($user->toArray())
        ]);
    }

    
    //要使用依赖注入
    //如果为传入方法，则输入composer dump-autoload在命令行
    public function show($id){
        $user = User::find($id);
        if (! $user){
            return $this->responseNotFound();
        }
        return $this->response([
            'status'=>'success',
            'data'=>$this->userTransformer->transform($user)
        ]);
    }

    public function store(Request $request){
//        dd($request);
        if (! $request->get('email') or ! $request->get('password') ){
            return $this->setStatusCode(422)->responseError('vaildate fails');
        }
        User::create($request->all());
        return $this->setStatusCode(201)->response([
            'status'=>'success',
            'message'=>'lesson created',
        ]);
    }
}
