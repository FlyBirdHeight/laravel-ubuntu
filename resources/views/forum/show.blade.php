@extends('app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" alt="64*64" style="height: 64px;width: 64px" src="{{$discussion->user->avatar}}">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        {{$discussion->title}}
                        @if(Auth::check() && Auth::user()->id == $discussion->user_id)
                            <a class="btn btn-primary btn-lg pull-right" href="/discussions/{{$discussion->id}}/edit" role="button" style="color: whitesmoke ">修改帖子</a>
                        @endif
                    </h4>
                    {{$discussion->user->name}}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main" id="post">
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        @foreach($discussion->tags as $tag)
                            <li style="display: inline-block;margin-left: 7px"><span class="label" style="background-color: {{$tag->color}}">{{$tag->name}}</span></li>
                        @endforeach
                    </ul>
                </div>
                <hr>
                <div class="blog-post">
                    {!! $html !!}
                </div><!-- /.blog-post -->
                <hr>
                <h3><strong>评论</strong></h3>
                @foreach($discussion->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" alt="64*64" style="width: 64px;height: 64px" src="{{$comment->user->avatar}}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{$comment->user->name}}</h4>
                            {!! $comment->body !!}
                            <br>
                            @if(Auth::check())
                                <button class="pull-left" style="margin-top: 15px;margin-bottom: 15px;margin-right: 15px;background-color: inherit;border-style: hidden;"
                                   onclick="if (document.getElementById('{{$comment->id}}').style.display == 'none'){document.getElementById('{{$comment->id}}').style.display='block'}else {document.getElementById('{{$comment->id}}').style.display='none'}">
                                    <font color="gray" face="微软雅黑">回复</font> </button>
                            @endif
                            @if(Auth::check() && Auth::user()->id == $discussion->user_id | Auth::user()->id == $comment->user_id)
                                <button class="pull-left" style="margin-top: 15px;margin-bottom: 15px;border-style: hidden;background-color: inherit"><font color="gray" face="微软雅黑">删除</font></button>
                            @endif
                            <div class="media-bottom" style="margin-top: 20px;display: none" id="{{$comment->id}}">
                                <textarea rows="5" class="form-control"></textarea>
                                <button class="btn pull-left" style="margin-right: 15px;margin-top: 15px" onclick="document.getElementById({{$comment->id}}).style.display = 'none'">取消回复</button>
                                <button class="btn btn-info pull-left" style="margin-top: 15px">发表回复</button>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if(Auth::check())
                    <div class="media" v-for="comment in comments">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" alt="64*64" style="width: 64px;height: 64px" src="@{{comment.avatar}}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">@{{comment.name}}</h4>
                            @{{comment.body}}
                            <br>
                            <button class="pull-left" style="margin-top: 15px;margin-bottom: 15px;margin-right: 15px;background-color: inherit;border-style: hidden;"
                               onclick="if (document.getElementById('@{{$comment->id}}').style.display == 'none'){document.getElementById('@{{$comment->id}}').style.display='block'}else {document.getElementById('@{{$comment->id}}').style.display='none'}">
                                <font color="gray" face="微软雅黑">回复</font> </button>
                            <a class="pull-left" href="#" style="margin-top: 15px;margin-bottom: 15px;border-style: hidden;background-color: inherit"><font color="gray" face="微软雅黑">删除</font></a>
                        </div>
                    </div>
                    <hr>
                    {!! Form::open(['url'=>'/comment','v-on:submit'=>'onSubmitForm']) !!}
                    {!! Form::hidden('discussion_id',$discussion->id) !!}
                    <div class="form-group">
                        <label>评论：</label>
                        {!! Form::textarea('body',null,['class'=>'form-control','v-model'=>'newComment.body','placeholder'=>'评论支持markdown语法，代码也可高亮显示']) !!}
                    </div>
                    <div>
                        {!! Form::submit('发表评论',['class'=>'btn btn-success pull-right']) !!}
                    </div>
                    {!! Form::close() !!}
                @else
                    <a class="btn btn-block btn-success" href="/user/login">登陆参与评论</a>
                @endif
            </div>
        </div>
    </div>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
    <script >hljs.initHighlightingOnLoad();</script>
    @if(Auth::check())
        <script>
            Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
            new Vue({
                el:'#post',
                data:{
                    comments:[],
                    newComment:{
                        name:'{{Auth::user()->name}}',
                        avatar:'{{Auth::user()->avatar}}',
                        body:''
                    },
                    newPost:{
                        discussion_id:'{{$discussion->id}}',
                        user_id:'{{Auth::user()->id}}',
                        body:''
                    }
                },
                methods:{
                    onSubmitForm:function (e) {
                        e.preventDefault();
                        var comment = this.newComment;
                        var post = this.newPost;
                        post.body = comment.body;
                        this.$http.post('/comment',post,function () {
                            this.comments.push(comment);
                        });
                        this.newComment = {
                            name:'{{Auth::user()->name}}',
                            avatar:'{{Auth::user()->avatar}}',
                            body:''
                        }
                    }

                }
            })
        </script>
    @endif
@stop