@extends('app')
@section('content')
    <div class="container" style="margin-top: 50px" >
        <div class="row">.
            <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Login
                </div>
                <div class="panel-body">
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
                    <form action="/user/login" method="post" style="margin-top: 20px">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>邮箱或用户名:</label>
                            <input type="text" name="login" class="form-control" placeholder="用户名或邮箱">
                        </div>
                        <div class="form-group" style="margin-top: 20px">
                            <label>密码:</label>
                            <input type="password" name="password" class="form-control" placeholder="密码">
                        </div>
                        <input class="btn btn-success form-control" type="submit" style="margin-top: 20px" value="马上登陆">
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>



@stop