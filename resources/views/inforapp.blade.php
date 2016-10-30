<!DOCTYPE html>
<html>
<head>
    <title>Personinfor</title>
    <!--mobile apps-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="My Resume Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
	SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--mobile apps-->
    <!--Custom Theme files-->
    <link href="{{asset('css/css/bootstrap.css')}}" type="text/css" rel="stylesheet" media="all">
    <link href="{{asset('css/css/style.css')}}" type="text/css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/css/swipebox.css')}}">
    <!--//Custom Theme files-->
    <!--js-->
    <script src="{{url('js/js/jquery-1.11.1.min.js')}}"></script>
    <!-- //js -->
    <!--web-fonts-->
    <link href='//fonts.googleapis.com/css?family=Overlock:400,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!--//web-fonts-->
    <!--start-smooth-scrolling-->
    <script type="text/javascript" src="{{url('js/js/move-top.js')}}"></script>
    <script type="text/javascript" src="{{url('js/js/easing.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!--//end-smooth-scrolling-->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.Jcrop.css')}}">;
    <script src="{{url('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{url('js/jquery.Jcrop.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>

    <script src="{{url('js/jquery.form.js')}}"></script>
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
                <li class="active"><a href="/">首页</a></li>
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