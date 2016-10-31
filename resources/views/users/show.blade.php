@extends('inforapp')
@section('content')
	<!--banner-->
	<div id="home" class="banner"  style="background-color: #4b4b4b">
		@foreach($user as $users)
			<div class="banner-info">
				<div class="container">
					<div class="col-md-4 header-left">
						<img class="media-object img-circle" src="{{$users->avatar}}" style="margin-top: 50px;height: 192px;width: 192px"/>
					</div>
					<div class="col-md-8 header-right">
						<h2>大家好</h2>
						<h1>我是 {{$users->name}}</h1>
						<h6>Web Designer and Developer</h6>
						<ul class="address">
							<li>
								<ul class="address-text">
									<li><b>电话 </b></li>
									<li>{{$users->phone}}</li>
								</ul>
							</li>
							<li>
								<ul class="address-text">
									<li><b>邮箱 </b></li>
									<li><a href="#"> {{$users->email}}</a></li>
								</ul>
							</li>
							<li>
								<ul class="address-text">
									<li><b>个人站点 </b></li>
									<li><a href="#">{{$users->web}}</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
	</div>
	<!--//banner-->
	<!--top-nav-->
	<div class="top-nav wow">
		<div class="container">
			<div class="navbar-header logo">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					Menu
				</button>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<div class="menu">
					<ul class="nav navbar">
						<li><a href="#about" class="scroll">关于{{$users->name}}</a></li>
						<li><a href="#work" class="scroll">{{$users->name}}的帖子收藏</a></li>
					</ul>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
	<!--//top-nav-->
	<!--about-->
	<div id="about" class="about">
		<div class="container">
			<h3 class="title"> 关于{{$users->name}}</h3>
			<div class="col-md-8 col-md-offset-3 about-left">
				{{$users->discuss}}
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//about-->
	<!--work-experience-->
	<div id="work" class="work">
		<div class="container">
			<h3 class="title">{{$users->name}}帖子收藏</h3>
			@foreach($favourite as $like)
				@if($like->id%2==0)
					<div class="work-info">
						<div class="col-md-6 work-left">
							<h4> {{$like->created_at}}</h4>
						</div>
						<div class="col-md-6 work-right">
							<a href="/discussions/{{$like->id}}"><h5><span class="glyphicon fa fa-briefcase"> </span> {{$like->title}}</h5></a>
							<p> </p>
						</div>
						<div class="clearfix"> </div>
					</div>
				@else
					<div class="work-info">
						<div class="col-md-6 work-right work-right2">
							<h4> {{$like->created_at}}</h4>
						</div>
						<div class="col-md-6 work-left work-left2">
							<a href="/discussions/{{$like->id}}"><h5> {{$like->title}} <span class="glyphicon fa fa-briefcase"> </span></h5></a>
							<p> </p>
						</div>
						<div class="clearfix"> </div>
					</div>
				@endif
			@endforeach
		</div>
	</div>
	@endforeach
	<!--//work-experience-->
	<!--footer-->
	<div class="footer" style="margin-top: -30px">
		<div class="container">
			<p>© 2016 My Resume. All rights reserved | Design by <a href="#">AdsionLi</a></p>
		</div>
	</div>
	<!--//footer-->
	<!--smooth-scrolling-of-move-up-->
	<script type="text/javascript">
		$(document).ready(function() {

			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
			};

			$().UItoTop({ easingType: 'easeOutQuart' });

		});
	</script>
	<!--//smooth-scrolling-of-move-up-->
	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
@stop
