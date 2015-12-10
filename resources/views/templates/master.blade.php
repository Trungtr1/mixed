<html>
    <head>
        <title>@yield('title')</title>
		<link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
		
		<script src="{{ asset('public/js/jquery.min.js') }}"></script>
		<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('public/js/dataTables.bootstrap.min.js') }}"></script>
		<script src="{{ asset('public/js/app.js?v=1.1') }}"></script>
    </head>
    <!--<body style="background-color:#F5F5F5;">-->
	<body>
		<style>
			#header{
				background-color:#428bca;
				position: fixed;
				top:0px;
				left: 0;
				width:100%;
				z-index:100;
			}
			.pd0{
				padding:0px;
			}
			.navbar-default{
				background-color:#428bca;
				margin:0px;
				border:0px;
			}
			.navbar-nav li{
				height:50px;
				line-height:50px;
			}
			.navbar-nav li a{
				line-height:30px;
			}
			#footer{				
				background: #f5f5f5;
				color: #fff;
				position: fixed;
				padding: 10px 0;
				left: 0;
				bottom: 0px;
				width:100%
			}
		</style>
		<div id="header" >
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 top-header">
						<!--<div id="logo" style="" class="col-lg-2 col-md-2 pd0">
							<b style="font-size:32px;height:26px;color:#fff">Mixed</b>
						</div>
						<div class="col-lg-10 col-md-10">								
							<div class="header-title" style="font-size: 18px;padding:0;">
								@if (Auth::check())	
									<a href="/logout" style="color:#fff;float:right;"><span class="glyphicon glyphicon-off"></span>&nbsp;Đăng xuất</a>
								@else
									<a href="/login" style="color:#fff;float:right;">Đăng nhập</a>
								@endif
							</div>	
						</div>-->
						<nav class="navbar navbar-default">
							<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<a class="navbar-brand" href="/home">TRONDE</a>									
								</div>
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
									<ul class="nav navbar-nav">
										<!--<li class="active"><a href="/home">Trang chủ <span class="sr-only">(current)</span></a></li>-->
										<li><a href="/home">Trang chủ</a></li>
										@if (Auth::check())	
											<li><a href="/user">Trang cá nhân</a></li>
										@endif
										<li><a href="/manual">Hướng dẫn sử dụng</a></li>
										@if (Auth::check() && Auth::user()->role==3)
											<li><a href="/admin">&nbsp;Admin</a></li>
										@endif	
									</ul>
									<ul class="nav navbar-nav navbar-right">
										@if (Auth::check())	
											<li><a href="/logout"><span class="glyphicon glyphicon-off"></span>&nbsp;Đăng xuất</a></li>
										@else
											<li><a href="/login">Đăng nhập</a></li>
										@endif
									</ul>
								</div><!-- /.navbar-collapse -->
							</div>
						</nav>						
					</div>
				</div>				
			</div>	
		</div>
		<div id="main-content" style="margin-top:50px;">			
			<div class="row">
				<div class="col-lg-12 col-md-12 pd0">
					@yield('content')
				</div>
			</div>
		</div>			
		<div id="footer" style="height:40px;">
			<?php if($_SERVER['HTTP_HOST'] == 'tronde.vn'): ?>
				<script>
				  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement
				(o)
				,
				  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				  ga('create', 'UA-71019152-1', 'auto');
				  ga('send', 'pageview');
				</script>
			<?php endif; ?>
			<div class="container">
				<p class="text-muted">Copyright PLS © 2015 - Developed by PLS Team | Supported by <a href="http://www.vnfoundation.org/" target="_blank">The Vietnam Foundation</a></p>
			</div>
		</div>
	</body>
</html>