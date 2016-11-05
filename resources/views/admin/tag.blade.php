@extends('adminapp')
@section('content')
    <div class="jumbotron" style="margin-top: -20px">
        <div class="container">
            <h2>Adsion App社区标签信息
                <a class="btn btn-info btn-lg pull-right" href="#" role="button" style="color: whitesmoke">添加新的标签</a>
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
                        <th>标签名</th>
                        <th>标签名颜色</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr class="info">
                            <td>{{$tag->id}}</td>
                            <td>{{$tag->name}}</td>
                            <td>{{$tag->color}}</td>
                            <td>
                                <a href="#" role="button" class="btn btn-danger">删除该标签</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop