@extends('app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2>欢迎来到Adsion App社区！
                <a class="btn btn-info btn-lg pull-right" href="/discussions/create" role="button" style="color: whitesmoke">发布新的帖子</a>
            </h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                @foreach($discussions as $discussion)
                    <div class="media">
                        <div class="media-left">
                            @if(Auth::check())
                                @if(in_array($discussion->id,$favourites))
                                    {!! Form::open(['method'=>'DELETE','url'=>'/favourite/'.$discussion->id]) !!}
                                @else
                                    {!! Form::open(['url'=>'/favourite']) !!}
                                    {!! Form::hidden('discussion_id',$discussion->id) !!}
                                @endif
                                <button type="submit" style="background-color: transparent;border-style: none"><i class="fa fa-heart {{in_array($discussion->id,$favourites)?'favorite':'not-favorite'}}"></i></button>
                                {!! Form::close() !!}
                            @endif
                        </div>
                        <div class="media-left">
                            <a href="{{url('infor/'.$discussion->user->id)}}">
                                <img class="media-object img-circle" alt="64*64" src="{{$discussion->user->avatar}}" style="height: 64px;width: 64px">
                            </a>
                        </div>
                        <div class="media-body">
                            <blockquote>
                            <h4 class="media-heading">
                                <a href="/discussions/{{$discussion->id}}">{{$discussion->title}}</a>
                                <div class="media-conversation-meta">
                                    <span class="media-conversation-replies">
                                        <a>{{ count($discussion->comments) }}</a>
                                        回复
                                    </span>
                                    <br>
                                </div>
                            </h4>
                                <font color="#dc143c" face="微软雅黑" size="1px">{{$discussion->user->name}}</font>
                                <font color="gray" face="微软雅黑" size="1px">发表于{{$discussion->created_at->diffForHumans()}}</font>
                            </blockquote>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop