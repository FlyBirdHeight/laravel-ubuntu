<?php

namespace App\Http\Controllers;

use App\Article;
use App\Discussion;
use App\Markdown\Markdown;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $markdown;
    public function __construct(Markdown $markdown)
    {
        $this->markdown = $markdown;
    }



    //tag
    public function taginfor(){
        $tags = Tag::orderBy('created_at')->paginate(15);
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

    public function discussdelete($id){
        $re = Discussion::where('id',$id)->delete();
        if ($re){
            $data = 1;
        }else{
            $data = 0;
        }
        return $data;
    }
    
    //article
    public function articleinfo(){
        $articles = Article::orderBy('id','desc')->paginate(10);
        return view('admin.article',compact('articles'));
    }
    
    public function article(){
        $tags = Tag::lists('name','id');
        return view('admin.articlecreate',compact('tags'));
    }

    public function articlecreate(Requests\DiscussionsRequest $request){
        $data = [
            'user_id'=>Auth::user()->id,
            'last_user_id'=>Auth::user()->id,
        ];
        $article = Article::create(array_merge($request->all(),$data));
        $article->tags()->attach($request->get('tag_list'));
        return redirect()->action('AdminController@articleinfo');
    }

    public function articledelete($id){
        $re = Article::where('id',$id)->delete();
        if ($re){
            $data = 1;
        }else{
            $data = 0;
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('created_at')->paginate(15);
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
