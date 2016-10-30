@extends('app')
@section('content')
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
                @if(Session::has('user_password_failed'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('user_password_failed')}}
                    </div>
                @endif
                <form action="/user/password/change" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>原密码:</label>
                        <input type="password" name="password_old" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>新密码:</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>确认密码:</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <input class="btn btn-success form-control" type="submit" value="更改密码">
                </form>
            </div>
        </div>
    </div>
@stop