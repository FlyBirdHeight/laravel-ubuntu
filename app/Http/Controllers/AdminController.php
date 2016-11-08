<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Markdown\Markdown;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $markdown;
    public function __construct(Markdown $markdown)
    {
        $this->markdown = $markdown;
    }



    //tag
    public function taginfor(){
        $tags = Tag::all();
        return view('admin.tag',compact('tags'));
    }
    
    public function tagcreate(Requests\TagRequest $request){
        $tags = Tag::create($request->except('_token'));
        return redirect()->action('AdminController@taginfor');
    }

    public function tagdelete($id){
        $re = Tag::where('id',$id)->delete();
        if ($re){
            $data = 1;
        }else{
            $data = 0;
        }
        return $data;
    }

    //帖子管理
    public function discussinfo(){
        $discuss = Discussion::orderBy('created_at','desc')->paginate(15);
        return view('admin.discuss',compact('discuss'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('admin.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
