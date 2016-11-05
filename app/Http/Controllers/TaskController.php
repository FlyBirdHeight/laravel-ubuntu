<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    public function show(){

    }

    public function index(){
        return Task::latest()->get();
    }

    public function store(Request $request){
        $task = Task::create($request->all());
        return Response::json([
            'status'=>'success',
            'task'=>$task
        ]);
    }

    public function destroy($id){
        Task::where('id',$id)->delete();
        return Response::json([
            'message'=>'success'
        ]);
    }
}
