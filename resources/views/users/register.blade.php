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
            <form action="/user/register" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label>用户名:</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>邮箱:</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label>密码:</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>确认密码:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <input class="btn btn-success form-control" type="submit" value="马上注册">
            </form>
        </div>
    </div>
</div>
@stop