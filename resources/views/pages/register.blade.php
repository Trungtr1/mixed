@extends('templates.master')

@section('title', 'Login')

@section('content')
<style>
	.box{
		margin-top:40px;
	}
</style>
<div class="container">
	<div class="content">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			@if (Session::has('responseData'))
			@if (Session::get('responseData')['statusCode'] == 1)
				<div class="alert alert-success">{{ Session::get('responseData')['message'] }}</div>
			@elseif (Session::get('responseData')['statusCode'] == 2)
				<div class="alert alert-danger">{{ Session::get('responseData')['message'] }}</div>
			@endif
			@endif

			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			
				{!! Form::open(array('method' => 'POST' )) !!}
				
				<div class="box col-lg-5 col-md-5">
					<div class="form-group">					
						<label>Email: <span style="color:red">*</span></label>
						<input type="text" name="email" id="email" class="form-control" value="" />
					</div>
					<div class="form-group">					
						<label>Mật khẩu: <span style="color:red">*</span></label>
						<input type="password" name="password" id="password" class="form-control" value="" />
					</div>
					<div class="form-group">					
						<label>Mật khẩu xác nhận: <span style="color:red">*</span></label>
						<input type="password" name="confirm_psw" id="confirm_psw" onblur="myFunction()" class="form-control" value="" />
					</div>
					<div class="form-group">					
						<label>Họ tên: <span style="color:red">*</span></label>
						<input type="text" name="fullname" id="fullname" class="form-control" value="" />
					</div>
					<div class="form-group">					
						<label>Số điện thoại:</label>
						<input type="text" name="phone" id="phone" class="form-control" value="" />
					</div>
					<div class="form-group">					
						<label>Địa chỉ:</label>
						<input type="text" name="address" id="address" class="form-control" value="" />
					</div>
					<div class="form-group">					
						<span style="color:red">Chú ý: những mục đánh dấu (*) là bắt buộc phải điền</span>
					</div>
					<div class="form-group">					
						<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Đăng ký" />
					</div>
				<div>
					
				{!! Form::close() !!}
				
		</div>
	</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(document).on('click','#submit',function(){
			var $email = $('#email').val();
			var $fullname = $('#fullname').val();
			var $password = $('#password').val();
			var $confirm_psw = $('#confirm_psw').val();
			if($email=="" || $fullname=="" || $password=="" || $confirm_psw==""){
				alert("Những mục đánh dấu * không được bỏ trống");
				return false;
			}else{
				if($password!=$confirm_psw){
					alert("Mật khẩu xác nhận không chính xác");
					return false;
				}else{
					return true;
				}		
			}
		})
	})
	function myFunction() {
		var $password = $('#password').val();
		var $confirm_psw = $('#confirm_psw').val();
		if($password!=$confirm_psw){
			alert("Mật khẩu xác nhận không chính xác");
		}
	}
</script>
@endsection