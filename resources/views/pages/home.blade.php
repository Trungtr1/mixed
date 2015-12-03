@extends('templates.master')

@section('title', 'Home')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

<style>
	.layout {
		margin: 150px 0px 0px 0px;
		width: 100%;
		display: table;
		font-weight: 100;
		font-family: 'Lato';
		text-align:center;
	}
	
	.title {
		font-size: 96px;
	}
	.title2 {
		font-size: 48px;
	}
</style>
	<div class="container">
		<div class="content">
			<div class="layout">
				<span class="title">tronde</span><span class="title2">.</span><span class="title">vn</span>
			</div>
		</div>
	</div>
</div>	
@endsection