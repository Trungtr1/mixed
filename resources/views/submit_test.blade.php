@extends('templates.master')

@section('title', 'Bài kiểm tra')

@section('content')
<style>
	td{
		padding:5px 10px 5px 10px;
	}
	tr{
		height:40px;
	}
	.groups:hover{
		//background-color:#DDF0F7;
		background-color:#F5F5F5;
	}
	.icon{
		padding-left: 3px;
		padding-right: 3px;
		padding-top: 2px;
		padding-bottom: 2px;
	}
	.nav-pills .active{
		display:none;
	}
	.col-header{
		border-right:1px solid #ccc;
		border-bottom:1px solid #ccc;
	}
	.col-body{
		border-bottom:1px solid #ccc;
	}
	.tct{
		text-align:center;
	}	
</style>
<div class="box">
	<div class="container">
		<br/>
		<div class="row">
			<div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
				<h3>Danh sách bài đã nộp</h3>				
			</div>
		</div>
		<br/>		
		<div class="row">
			<div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
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
				<div class="row" style="padding:0px">
					<div class="panel panel-default">
						<div class="panel-body" style="padding:10px">
							<div class="col-lg-3 col-md-3" style="text-align:center">
								<span class="glyphicon glyphicon-folder-open" style="color:#A9A9A9"></span>&nbsp;&nbsp;thư mục
							</div>
							<div class="col-lg-3 col-md-3" style="text-align:center">
								<span class="glyphicon glyphicon-file" style="color:#A9A9A9"></span>&nbsp;file
							</div>
							<div class="col-lg-3 col-md-3" style="text-align:center">
								<span class="glyphicon glyphicon-star" style="color:#A9A9A9"></span>&nbsp;yêu thích
							</div>
							<div class="col-lg-3 col-md-3" style="text-align:center">
								<span class="glyphicon glyphicon-user" style="color:#A9A9A9"></span>&nbsp;thành viên
							</div>
						</div>
						<div class="panel-heading" style="padding:0px 0px 8px 0px">
							<div class="col-lg-6 col-md-6" style="background-color:#f1e05a;height:8px">
							</div>
							<div class="col-lg-3 col-md-3" style="background-color:#4F5D95;height:8px">
							</div>
							<div class="col-lg-2 col-md-2" style="background-color:#e44b23;height:8px">
							</div>
							<div class="col-lg-1 col-md-1" style="background-color:#563d7c;height:8px">
							</div>
						</div>
					</div>
				</div>
				<br/>
				<div class="row" style="padding:0px">
					<div class="panel panel-default">
						<div class="panel-body" style="padding:0px">							
							<table style="width:100%;padding:0px">
								<tr>
									<td class="col-header th">Thông tin người nộp</td>
									<td class="col-header tct th" style="width:150px;">Ngày sửa đổi</td>
								</tr>
								<?php foreach($data['tests'] as $fi){ ?>
									<tr class="groups">
										<td class="col-body">												
											<a href="/cham-bai?id=<?php echo $fi['id'] ?>" style="font-size:11pt;"><span class="glyphicon glyphicon-list-alt" style="color:#000"></span>&nbsp;&nbsp;<?php echo $fi['people_info'] ?></a>
										</td>
										<td class="col-body tct">
											<span style="color:#A9A9A9"><?php echo $fi['date'] ?><span>
										</td>
									</tr>
								<?php } ?>
							</table>						
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_sms" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Địa chỉ email nhận bài kiểm tra</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(array('method' => 'POST','id'=>'frm_sms','files' => 'true')) !!}
					<div class="row">
						<input type="radio" name="choose" class="rd-email" data-id="1" checked="true"/>&nbsp;<label>Gửi tới 1 địa chỉ duy nhất:</label>
					</div>
					<div class="row">
						<input type="text" name="email" id="email_1" class="form-control em" value="" placeholder="Địa chỉ hòm thư"/>
					</div>
					<br/>
					<div class="row">
						<input type="radio" name="choose" class="rd-email" data-id="2"/>&nbsp;<label>Gửi tới nhiều địa chỉ:</label>
					</div>
					<div class="row">
						<input type="file" name="list_email" id="email_2" class="form-control em" value="" disabled ="true"/>
						<input type="hidden" name="test_id" id="test_id" class="form-control" value="" />
					</div>
				{!! Form::close() !!}
			</div>
			<div class="modal-footer">				
			  <button type="submit" class="btn btn-primary" id="submit_sms" data-dismiss="modal">Gửi bài</button>
			</div>
		</div>	  
	</div>
</div>
<script>
	$(document).on('click','.rd-email',function(){		
		$('.em').prop('disabled',true);
		var id = $(this).attr('data-id');
		$('#email_'+id).removeAttr('disabled');
	})
	
	$(document).on('click','#submit_sms',function(){
		$('#frm_sms').submit();
	})
	$(document).on('click','.btn-sms',function(){
		$id = $(this).attr('data-id');
		$("#test_id").val($id);
	})
</script>
@endsection