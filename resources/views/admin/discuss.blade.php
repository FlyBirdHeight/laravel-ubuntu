@extends('adminapp')
@section('content')
    <div class="jumbotron" style="margin-top: -20px">
        <div class="container">
            <h2>Adsion App社区帖子信息
                {{--<!-- Button trigger modal -->--}}
                {{--<button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#myModalcreate">--}}
                {{--添加新帖子--}}
                {{--</button>--}}
                {{--<!-- Modal -->--}}
                {{--<div class="modal fade" id="myModalcreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabelcreate">--}}
                {{--<div class="modal-dialog" role="document">--}}
                {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                {{--<h4 class="modal-title" id="myModalLabelcreate">新帖子添加</h4>--}}
                {{--</div>--}}
                {{--<form action="/admin/tag" method="post">--}}
                {{--{{csrf_field()}}--}}
                {{--<div class="form-group">--}}
                {{--<h4>名 称:</h4>--}}
                {{--<input type="text" class="form-control" name="title">--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                {{--<h4>颜 色:</h4>--}}
                {{--<input type="color" name="color" class="form-control">--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<input type="submit" class="form-control btn btn-success" value="创建标签">--}}
                {{--</div>--}}
                {{--</form>--}}
                {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12" role="main">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>发帖人</th>
                        <th>id</th>
                        <th>帖子标题</th>
                        <th>帖子创建时间</th>
                        <th>帖子详情</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($discuss as $discussion)
                        <tr class="info">
                            <td>{{$discussion->user->name}}</td>
                            <td>{{$discussion->id}}</td>
                            <td>{{$discussion->title}}</td>
                            <td>{{$discussion->created_at}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$discussion->id}}">
                                    帖子信息详情
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal{{$discussion->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$discussion->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel{{$discussion->id}}">帖子信息详情</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h4>帖子创建时间:{{$discussion->created_at}}</h4>
                                                <h4>帖子更新时间:{{$discussion->updated_at}}</h4>
                                                <h4>回帖内容:<br>
                                                    @foreach($discussion->comments as $comment)
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
                                <a href="javascript:;" role="button" class="btn btn-danger" onclick="delCate({{$discussion->id}})">删除帖子</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {!! $discuss->render() !!}
    </div>

    <script>
        function delCate(discuss_id) {
            swal({
                title: "是否删除?",
                text: "你这个操作将会删除这个帖子且不能恢复!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "是的，删除这个帖子",
                closeOnConfirm: false
            }, function(){
                $.post("{{url('admin/discuss/')}}/"+discuss_id,{'_method':'delete','_token':"{{csrf_token()}}"}).done(function(data) {
                    location.href = location.href;
                }).error(function(data) {
                    swal("OMG", "删除操作失败了!", "error");
                });
            });
        }
    </script>
@stop