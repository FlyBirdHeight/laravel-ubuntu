@extends('app')
@section('content').
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" role="main">
            @if($errors->any())
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            @if(Session::has('user_login_failed'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('user_login_failed')}}
                </div>
            @endif
            <form action="/user/login" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label>邮箱或用户名:</label>
                    <input type="text" name="login" class="form-control">
                </div>
                <div class="form-group">
                    <label>密码:</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <input class="btn btn-success form-control" type="submit" value="马上登陆">
            </form>
        </div>
    </div>
</div>
@stop