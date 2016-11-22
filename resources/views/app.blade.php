<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adsion</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="http://cdn.bootcss.com/select2/4.0.1/css/select2.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/jquery-jcrop/2.0.4/css/Jcrop.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/highlight.js/9.8.0/styles/atom-one-light.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/select2/4.0.1/js/select2.full.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery-jcrop/2.0.4/js/Jcrop.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{url('js/jquery.form.js')}}"></script>
    <script src="http://cdn.bootcss.com/vue/1.0.14/vue.min.js"></script>
    <script src="http://cdn.bootcss.com/vue-resource/0.6.1/vue-resource.min.js"></script>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet'>
    <meta id="token" name="token" value="{{csrf_token()}}">
</head>
<body>
<!-- Static navbar -->
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header navbar">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse" id="select">
            <ul class="nav navbar-nav">
                <li><a class="navbar-brand" href="/">Adsion country</a></li>
                <li class="active"><a href="/"><span class="fa fa-cloud"></span> 首页</a></li>
                <li class="active"><a href="#"><span class="fa fa-pencil"></span> 文章区（还在紧急制作中）</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search" method="post" action="/user/search">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="search" id="select" onkeyup="myText()">
                </div>
                <button type="submit" class="btn btn-default" id="btnAdd" disabled="disabled">查找帖子</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            @can('edit_form')
                                <li><a href="/admin"><i class="fa fa-briefcase"></i> 进入管理员页面</a></li>
                            @endcan
                            <li><a href="/user/avatar"> <i class="fa fa-user"></i> 修改个人信息</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> 查看收藏贴</a>
                            <li><a href="/user/password"> <i class="fa fa-cog"></i> 更换密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li> <a href="/logout">  <i class="fa fa-sign-out"></i> 退出登录</a></li>
                        </ul>
                    </li>
                    <li><img src="{{Auth::user()->avatar}}" class="img-circle" alt="50*50" style="width: 50px;height: 50px"> </li>
                @else
                    <li><a href="/user/login">登  陆</a></li>
                    <li><a href="/user/register">注  册</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
@yield('content')
@include('flashy::message')
<script>
    $(document).ready(function () {
        $('#select').on('keyup',function () {
            var v = $('#select').val();
            v = $.trim(v);
            if (!v){
                $('#btnAdd').attr('disabled',true)
            }else{
                $('#btnAdd').attr('disabled',false)
            }
        })
    });
</script>
</body>
</html>