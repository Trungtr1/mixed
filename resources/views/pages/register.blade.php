@extends('templates.master')

@section('title', 'Login')

@section('content')
<style>
	.box{
		margin-top:40px;
	}
</style>
<div class="container">
	<br/>
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
			{!! Form::open(array('method' => 'POST','enctype'=>'multipart/form-data', 'files' => true )) !!}
			@if (!isset($data['user']))			
				<div class="col-lg-5 col-md-5">
					<div class="form-group">					
						<label>Email: <span style="color:red">*</span></label>
						{!! Form::text('email', null, array('class'=>'form-control','id'=>'email')) !!}
					</div>					
					<div class="form-group">
						<label>Mật khẩu: <span style="color:red">*</span></label>
						{!! Form::password('password', array('class'=>'form-control','id'=>'password')) !!}
					</div>					
					<div class="form-group">					
						<label>Mật khẩu xác nhận: <span style="color:red">*</span></label>
						{!! Form::password('confirm_psw', array('class'=>'form-control','id'=>'confirm_psw')) !!}
					</div>					
					<div class="form-group">					
						<label>Họ tên: <span style="color:red">*</span></label>
						{!! Form::text('fullname',null, array('class'=>'form-control','id'=>'fullname')) !!}
					</div>
					<div class="form-group">					
						<label>Số điện thoại:</label>
						{!! Form::text('phone', null, array('class'=>'form-control','id'=>'phone')) !!}
					</div>
					<div class="form-group">					
						<label>Địa chỉ:</label>
						{!! Form::text('address', null, array('class'=>'form-control','id'=>'address')) !!}
					</div>
					<hr/>					
					<div class="form-group">					
						<span style="color:red">Chú ý: những mục đánh dấu (*) là bắt buộc phải điền</span>
					</div>
					<div class="form-group">					
						<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Đăng ký" />
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group" >
						<div id="upanh">
							<a> 
								<img class='col-md-12' style="padding:6px;border:2px dashed #0087F7;height:200px;width:150" id="img" 
								src="<?= asset('public/img/avata/avata_default.jpg');?>" alt="Chọn ảnh" />									
							</a>									
						</div>			
						{!! Form::file('avata', array('class'=>'form-control','style'=>'display:none;','id'=>'imgInp')) !!}
					</div>	
				</div>
			@else			
				<div class="col-lg-5 col-md-5">
					<div class="form-group">					
						<label>Email: <span style="color:red">*</span></label>
						{!! Form::text('email', @$data['user']['email'], array('class'=>'form-control','id'=>'email')) !!}
					</div>					
					<div class="form-group">					
						<label>Mật khẩu: <span style="color:red">*</span></label>
						{!! Form::password('password_old', array('class'=>'form-control','id'=>'password_old')) !!}
					</div>					
					<div class="form-group">					
						<label>Họ tên: <span style="color:red">*</span></label>
						{!! Form::text('fullname', @$data['user']['fullname'], array('class'=>'form-control','id'=>'fullname')) !!}
					</div>
					<div class="form-group">					
						<label>Số điện thoại:</label>
						{!! Form::text('phone', @$data['user']['phone'], array('class'=>'form-control','id'=>'phone')) !!}
					</div>
					<div class="form-group">					
						<label>Địa chỉ:</label>
						{!! Form::text('address', @$data['user']['address'], array('class'=>'form-control','id'=>'address')) !!}
					</div>
					<hr/>
					<div class="form-group">					
						<span style="color:red">Mục này chỉ điền nếu bạn muốn đổi mật khẩu mới</span>
					</div>
					<div class="form-group">
						@if (!isset($data['user']))	
							<label>Mật khẩu: <span style="color:red">*</span></label>
						@else
							<label>Mật khẩu mới: <span style="color:red">*</span></label>
						@endif	
						{!! Form::password('password', array('class'=>'form-control','id'=>'password')) !!}
					</div>					
					<div class="form-group">					
						<label>Mật khẩu xác nhận: <span style="color:red">*</span></label>
						{!! Form::password('confirm_psw', array('class'=>'form-control','id'=>'confirm_psw')) !!}
					</div>
				<hr/>					
					<div class="form-group">					
						<span style="color:red">Chú ý: những mục đánh dấu (*) là bắt buộc phải điền</span>
					</div>
					<div class="form-group">					
						<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Cập nhật" />
						<?php if($data['user']){ ?>
						<input type="hidden" name="id" class="form-control" value="<?php echo $data['user']['id'] ?>" />
						<?php } ?>
					</div>					
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group" >
						<div id="upanh">
							<a> 
								<img class='col-md-12' style="padding:6px;border:2px dashed #0087F7;height:200px;width:150" id="img" 
								src="<?=(isset($data['user']) && $data['user']['avata']!='')? asset('public/img/avata/'.$data['user']['avata']) : asset('public/img/avata/avata_default.jpg');?>" alt="Chọn ảnh" />									
							</a>									
						</div>			
						{!! Form::file('avata', array('class'=>'form-control','style'=>'display:none;','id'=>'imgInp')) !!}
					</div>	
				</div>
			@endif					
			{!! Form::close() !!}
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(document).on('click','#submit',function(){
			var $email = $('#email').val();
			var $fullname = $('#fullname').val();
			var $password_old = $('#password_old').val();
			if($email=="" || $fullname==""){
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
		});
		
		function readURL(input, bien) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#' + bien).attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$(document).on('change','#imgInp',function(){
			readURL(this, 'img');
		});

		$(document).on('click','#upanh a',function(){
			$('#imgInp').click();
		});
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