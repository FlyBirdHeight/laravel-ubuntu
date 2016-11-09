@extends('adminapp')
@section('content')
    <div class="jumbotron" style="margin-top: -20px">
        <div class="container">
            <h2>Adsion App社区标签信息
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#myModalcreate">
                    添加新标签
                </button>
                <!-- Modal -->
                <div class="modal fade" id="myModalcreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabelcreate">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabelcreate">新标签添加</h4>
                            </div>
                            <form action="/admin/tag" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <h4>名 称:</h4>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <h4>颜 色:</h4>
                                    <input type="color" name="color" class="form-control">
                                </div>
                                <div>
                                    <input type="submit" class="form-control btn btn-success" value="创建标签">
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </h2>
        </div>
    </div>
    @if($errors->any())
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong>{{$error}}</strong> </li>
            @endforeach
        </ul>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12" role="main">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>标签名</th>
                        <th>标签名颜色</th>
                        <th>帖子详情</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr class="info">
                            <td>{{$tag->id}}</td>
                            <td>{{$tag->name}}</td>
                            <td>{{$tag->color}}</td>
                            <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$tag->id}}">
                                    查看详情
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$tag->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel{{$tag->id}}">标签详情</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h4>父级标签:</h4>
                                                <h4>标签名：{{$tag->name}}</h4>
                                                <h4>标签颜色:{{$tag->color}}</h4>
                                                <h4>标签创建时间:{{$tag->created_at}}</h4>
                                                <h4>标签更新时间:{{$tag->updated_at}}</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;" role="button" class="btn btn-danger" onclick="delCate({{$tag->id}})">删除该标签</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {!! $tags->render() !!}
    </div>
    <script>
        function delCate(tag_id) {
            swal({
                title: "是否删除?",
                text: "你这个操作将会删除这个标签且不能恢复!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "是的，删除这个标签",
                closeOnConfirm: false
            }, function(){
                $.post("{{url('admin/tag/')}}/"+tag_id,{'_method':'delete','_token':"{{csrf_token()}}"}).done(function(data) {
                    location.href=location.href;
                }).error(function(data) {
                    swal("OMG", "删除操作失败了!", "error");
                });
            });
        }
    </script>
@stop