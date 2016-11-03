<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Favourite;
use App\Markdown\Markdown;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use YuanChao\Editor\EndaEditor;

class PostController extends Controller
{
    protected $markdown;

    public function __construct(Markdown $markdown)
    {
        $this->middleware('auth',['only'=>['create','store','edit','update']]);
        $this->markdown = $markdown;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = Discussion::latest()->get();
        if (Auth::check()){
            $favourites = Favourite::where('user_id',Auth::user()->id)
                ->lists('discussion_id')->ToArray();
            return view('forum.index',compact('discussions','favourites'));
        }else{
            return view('forum.index',compact('discussions'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::lists('name','id');
        return view('forum.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\DiscussionsRequest $request)
    {
        $data = [
            'user_id'=>Auth::user()->id,
            'last_user_id'=>Auth::user()->id,
        ];
        $discussion = Discussion::create(array_merge($request->all(),$data));
        $discussion->tags()->attach($request->get('tag_list'));
        return redirect()->action('PostController@show',['id'=>$discussion->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        $html = $this->markdown->markdown($discussion->body);
//        dd($discussion);
        return view('forum.show',compact('discussion','html'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discussion = Discussion::find($id);
        $tags = Tag::lists('name','id');
        if (Auth::user()->id !== $discussion->user_id){
            return redirect('/');
        }
        return view('forum.edit',compact('discussion','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\DiscussionsRequest $request, $id)
    {
        $discussion = Discussion::find($id);
        $discussion->title = $request->get('title');
        $discussion->body = $request->get('body');
        $discussion->tags()->sync($request->get('tag_list'));
        return redirect()->action('PostController@show',['id'=>$discussion->id]);
    }

    public function upload()
    {
        $data = EndaEditor::uploadImgFile('uploads');
        return json_encode($data);
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
