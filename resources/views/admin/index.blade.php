@extends('adminapp')
@section('content')
    <div class="jumbotron" style="margin-top: -20px">
        <div class="container">
            <h2>Adsion App社区会员信息</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12" role="main">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>用户详情</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $user)
                        <tr class="info">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$user->id}}">
                                    用户个人信息详情
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$user->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel{{$user->id}}">用户个人信息详情</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h4>真实姓名：{{$user->realname}}</h4>
                                                <h4>电话：{{$user->phone}}</h4>
                                                <h4>个人站点:{{$user->web}}</h4>
                                                <h4>注册时间：{{$user->created_at}}</h4>
                                                <h4>个人描述：<br>{{$user->discuss}}</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="#" role="button" class="btn btn-danger">注销该用户</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop