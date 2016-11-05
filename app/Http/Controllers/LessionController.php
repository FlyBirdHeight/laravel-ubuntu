<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Transform\LessonTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class LessionController extends ApiController
{
    protected $lessonTransformer;

    /**
     * LessionController constructor.
     * @param $lessonTransformer
     */
    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
        $this->middleware('auth.basic');
    }

    //all()这个方法是不好的（）
    //无法添加额外的信息，无提示信息(Response::json来添加额外的信息,ok)
    //直接展示我们的数据结构（使用字段映射来解决）
    //显示我们的错误提示，没有错误信息
    public function index(){
        $lesson = Lesson::all();
        return $this->response([
            'status'=>'success',
            'data'=>$this->lessonTransformer->transformCollection($lesson->toArray())
        ]);
    }

    
    //要使用依赖注入
    //如果为传入方法，则输入composer dump-autoload在命令行
    public function show($id){
        $lesson = Lesson::find($id);
        if (! $lesson){
            return $this->responseNotFound();
        }
        return $this->response([
            'status'=>'success',
            'data'=>$this->lessonTransformer->transform($lesson)
        ]);
    }

    public function store(Request $request){
//        dd($request);
        if (! $request->get('title') or ! $request->get('body') ){
            return $this->setStatusCode(422)->responseError('vaildate fails');
        }
        Lesson::create($request->all());
        return $this->setStatusCode(201)->response([
            'status'=>'success',
            'message'=>'lesson created',
        ]);
    }
}
