<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adsion</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.Jcrop.css')}}">;
    <script src="{{url('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{url('js/jquery.Jcrop.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/jquery.form.js')}}"></script>
    <script src="//cdn.bootcss.com/vue/1.0.14/vue.min.js"></script>
    <script src="//cdn.bootcss.com/vue-resource/0.6.1/vue-resource.min.js"></script>
    <meta id="token" name="token" value="{{csrf_token()}}">
</head>
<body>

<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-top: -20px">
    <div class="container">
        <div class="navbar-header navbar">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a class="navbar-brand" href="/">Adsion country</a></li>
                <li class="active"><a href="/"><span class="fa fa-cloud"></span> 首页</a></li>
                <li class="active"><a href="#"><span class="fa fa-pencil"></span> 文章区（还在紧急制作中）</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="/user/avatar"> <i class="fa fa-user"></i> 修改个人信息</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> 查看收藏贴</a>
                            <li><a href="/user/password"> <i class="fa fa-cog"></i> 更换密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li> <a href="/logout">  <i class="fa fa-sign-out"></i> 退出登录</a></li>
                        </ul>
                    </li>
                    <li><img src="{{Auth::user()->avatar}}" class="img-circle" width="50"> </li>

                @else
                    <li><a href="/user/login">登  陆</a></li>
                    <li><a href="/user/register">注  册</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
@yield('content')
</body>
</html>