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
                <div class="blog-post">
                    {!! $html !!}
                </div><!-- /.blog-post -->
                <hr>
                @foreach($discussion->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" alt="64*64" style="width: 64px;height: 64px" src="{{$comment->user->avatar}}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{$comment->user->name}}</h4>
                            {{$comment->body}}
                        </div>
                    </div>
                @endforeach
                {{--<div class="media" v-for="comment in comments">--}}
                    {{--<div class="media-left">--}}
                        {{--<a href="#">--}}
                            {{--<img class="media-object img-circle" alt="64*64" style="width: 64px;height: 64px" src="@{{comment.avatar}}">--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<div class="media-body">--}}
                        {{--<h4 class="media-heading">@{{comment.name}}</h4>--}}
                        {{--@{{comment.body}}--}}
                    {{--</div>--}}
                {{--</div>--}}
                <hr>
                @if(Auth::check())
                    {!! Form::open(['url'=>'/comment','v-on:submit'=>'onSubmitForm']) !!}
                        {!! Form::hidden('discussion_id',$discussion->id) !!}
                        <div class="form-group">
                            <label>评论：</label>
                            {!! Form::textarea('body',null,['class'=>'form-control','v-model'=>'newComment.body']) !!}
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
    {{--<script>--}}
        {{--Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');--}}
        {{--new Vue({--}}
            {{--el:'#post',--}}
            {{--data:{--}}
                {{--comments:[],--}}
                {{--newComment:{--}}
                    {{--name:'{{Auth::user()->name}}',--}}
                    {{--avatar:'{{Auth::user()->avatar}}',--}}
                    {{--body:''--}}
                {{--},--}}
                {{--newPost:{--}}
                    {{--discussion_id:'{{$discussion->id}}',--}}
                    {{--user_id:'{{Auth::user()->id}}',--}}
                    {{--body:''--}}
                {{--}--}}
            {{--},--}}
            {{--methods:{--}}
                {{--onSubmitForm:function (e) {--}}
                    {{--e.preventDefault();--}}
                    {{--var comment = this.newComment;--}}
                    {{--var post = this.newPost;--}}
                    {{--post.body = comment.body;--}}
                    {{--this.$http.post('/comment',post,function () {--}}
                        {{--this.comments.push(comment);--}}
                    {{--});--}}
                    {{--this.newComment = {--}}
                        {{--name:'{{Auth::user()->name}}',--}}
                        {{--avatar:'{{Auth::user()->avatar}}',--}}
                        {{--body:''--}}
                    {{--}--}}
                {{--}--}}
            {{--}--}}
        {{--})--}}
    {{--</script>--}}
@stop