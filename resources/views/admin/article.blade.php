@extends('adminapp')
@section('content')
    <div class="jumbotron" style="margin-top: -20px">
        <div class="container">
            <h2>Adsion App社区文章信息
                <a class="btn btn-info btn-lg pull-right" href="/admin/article/create" role="button" style="color: whitesmoke">发布新的文章</a>
            </h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12" role="main">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>文章标题</th>
                        <th>发布文章人</th>
                        <th>文章详情</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr class="info">
                            <td>{{$article->id}}</td>
                            <td>{{$article->title}}</td>
                            <td>{{$article->user->name}}</td>
                            <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$article->id}}">
                                    查看详情
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal{{$article->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$article->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel{{$article->id}}">文章详情</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h4>标签：</h4>
                                                <div class="navbar-collapse collapse">
                                                    <ul class="nav navbar-nav">
                                                        @foreach($article->tags as $tag)
                                                            <li style="display: inline-block;margin-left: 7px"><span class="label" style="background-color: {{$tag->color}}">{{$tag->name}}</span></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <h4>文章标题:{{$article->title}}</h4>
                                                <h4>文章创建时间:{{$article->created_at}}</h4>
                                                <h4>文章更新时间:{{$article->updated_at}}</h4>
                                                <h4>文章回帖:
                                                    @foreach($article->comments as $comment)
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <h4 class="media-heading">回帖人：{{$comment->user->name}}</h4>
                                                                回帖内容：{{$comment->body}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;" role="button" class="btn btn-danger" onclick="delCate({{$article->id}})">删除该文章</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {!! $articles->render() !!}
    </div>
    <script>
        function delCate(articles_id) {
            swal({
                title: "是否删除?",
                text: "你这个操作将会删除这篇文章且不能恢复!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "是的，删除这篇文章",
                closeOnConfirm: false
            }, function(){
                $.post("{{url('admin/article/')}}/"+articles_id,{'_method':'delete','_token':"{{csrf_token()}}"}).done(function(data) {
                    location.href=location.href;
                }).error(function(data) {
                    swal("OMG", "删除操作失败了!", "error");
                });
            });
        }
    </script>
@stop