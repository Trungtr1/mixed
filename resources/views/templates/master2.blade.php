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
		<script src="{{ asset('public/js/app.js?') }}"></script>
    </head>
    <!--<body style="background-color:#F5F5F5;">-->
	<body>
		<style>
			
		</style>
		<div id="header" >			
		</div>
		<div id="main-content" style="margin-top:50px;">			
			<div class="row">
				<div class="col-lg-12 col-md-12 pd0">
					@yield('content')
				</div>
			</div>
		</div>			
		<div id="footer" style="height:40px;">
			
		</div>
	</body>
</html>