@extends('templates.master')

@section('title', 'Thư mục chia sẻ')

@section('content')
<style>
	td{
		padding:5px 10px 5px 10px;
	}
	th{
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
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="col-lg-10 col-md-10 pd0">
					<h3>
						<button type="button" style="padding:12px;border-radius:20px;" class='btn btn-primary' onclick="goBack()"><span class="glyphicon glyphicon-arrow-left"></span></button>&nbsp;&nbsp;<?php echo $data['folder'][0]['name'] ?>
					</h3>
				</div>
				<div class="col-lg-2 col-md-2 pd0">
					
				</div>
			</div>			
		</div>
		<br/>
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
		<div class="row">
			<div class="col-lg-9 col-md-9">
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
				<div class="row" style="padding:0px">
					<div class="col-lg-6 col-md-6" style="padding:0px">
						
					</div>					
					<div class="col-lg-6 col-md-6" style="padding:0px">
						<table style="float:right">
							<tr>
								<td><button type="button" class="btn btn-warning" id="btn-test" data-toggle="modal" data-target="#modal_test"><span class="glyphicon glyphicon-refresh"></span> &nbsp;Kiểm tra</button></td>
								<td><button type="button" class="btn btn-danger" id="btn-mix" data-toggle="modal" data-target="#modal_mixed"><span class="glyphicon glyphicon-refresh"></span> &nbsp;Trộn đề</button></td>
							</tr>
						</table>
					</div>
				</div>
				<br/>
				<div class="row" style="padding:0px">
					<div class="panel panel-default">
						<div class="panel-body" style="padding:0px">
							<table style="width:100%;padding:0px">
									<tr>
										<td class="col-body th" style="width:35px"></td>
										<td class="col-header th">Tên</td>
										<td class="col-header tct th" style="width:150px;">Ngày sửa đổi</td>
										<td class="col-header tct th" style="width:150px;">Chia sẻ</td>
										<td class="col-body tct th" style="width:150px;">Chức năng</td>
									</tr>
									<?php foreach($data['subfolder'] as $ch){ ?>
										<tr class="groups">
											<td class="col-body">
												<input type="checkbox"  name="choosetest[]" value="<?php echo $ch['id'] ?>" class="cht folder" data-name="<?php echo $ch['name'] ?>"/>
											</td>
											<td class="col-body">												
												<a href="/folder?id=<?php echo $ch['id'] ?>" style="font-size:11pt"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<?php echo $ch['name'] ?></a>
											</td>
											<td class="col-body tct">
												<span style="color:#A9A9A9"><?php echo $ch['date'] ?><span>
											</td>
											<td class="col-body tct">
												<span style="color:#A9A9A9"><?php echo($ch['share']==0)?'Cá nhân':'Chia sẻ' ?><span>
											</td>
											<td class="col-body tct">
												<a href="/folder?id=<?php echo $data['folder'][0]['id'] ?>&action=like&folder_id=<?php echo $ch['id'] ?>">
													<button type="button" title="like" name="like" style="border:0px;background:none;"><span style="color:#159014" class='glyphicon glyphicon-star'></span></button>
												</a>
											</td>
										</tr>
									<?php } ?>
									<?php foreach($data['subfile'] as $fi){ ?>
										<tr class="groups">
											<td class="col-body">
												<input type="checkbox"  name="choosetest[]" value="<?php echo $fi['id'] ?>" class="cht file" data-name="<?php echo $fi['name'] ?>" data-cques="<?php echo $fi['count'] ?>"/>
											</td>
											<td class="col-body">												
												<a href="/file?id=<?php echo $fi['id'] ?>" style="font-size:11pt;"><span class="glyphicon glyphicon-list-alt" style="color:#000"></span>&nbsp;&nbsp;<?php echo $fi['name'] ?></a>
											</td>
											<td class="col-body tct">
												<span style="color:#A9A9A9"><?php echo $fi['date'] ?><span>
											</td>
											<td class="col-body tct">
												<span style="color:#A9A9A9"><?php echo($fi['share']==0)?'Cá nhân':'Chia sẻ' ?><span>
											</td>
											<td class="col-body tct">
												<a href="/folder?id=<?php echo $data['folder'][0]['id'] ?>&action=like&folder_id=<?php echo $fi['id'] ?>">
													<button type="button" title="like" name="like" style="border:0px;background:none;"><span style="color:#159014" class='glyphicon glyphicon-star'></span></button>
												</a>
											</td>
										</tr>
									<?php } ?>
								</table>
								{!! Form::open(array('route' => 'mix.to.folder', 'method' => 'POST', 'class' => 'inline', 'id' => 'mix-question-form', 'files' => 'true' )) !!}
									<div class="modal fade" id="modal_mixed" role="dialog">											
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
												  <button type="button" class="close" data-dismiss="modal">&times;</button>
												  <h4 class="modal-title">Thông tin bổ sung</h4>
												</div>
												<div class="modal-body">
																
														<div class="row">
															<div class="tab-content col-sm-12">
																<div class="tab-pane active" id="tab1">
																	<div class="row">
																		<label>Số lượng đề cần tạo:</label>
																	</div>
																	<div class="row">
																		<input type="text" name="number_tests" class="form-control" value="" />
																	</div>																	
																	<br/>
																	<div class="row">
																		<label>Tên đơn vị:</label>
																	</div>
																	<div class="row">
																		<input type="text" name="school" class="form-control" value="" />
																	</div>
																	<br/>
																	<div class="row">
																		<label>Tiêu đề:</label>
																	</div>
																	<div class="row">
																		<input type="text" name="title" class="form-control" value="" />
																	</div>
																	<br/>
																	<div class="row">
																		<label>Tên môn:</label>
																	</div>
																	<div class="row">
																		<input type="text" name="subject" class="form-control" value="" />
																	</div>
																	<br/>
																	<div class="row">
																		<label>Thời gian:</label>
																	</div>
																	<div class="row">
																		<input type="text" name="time" class="form-control" value="" />
																	</div>																		
																</div>
																<div class="tab-pane" id="tab2">	
																	<div id="list_file">
																		
																	</div>
																	<br/>
																	<div class="row">
																		<label>Số lượng câu hỏi mỗi đề:&nbsp;<span id="total_question" style="color:red"></span></label>
																		<input type="hidden" name="ipt_total_question" id="ipt_total_question" value='' />
																	</div>																	
																	<br/>
																	<div class="row">
																		<button type="submit" class="btn btn-primary" id="mixed" data-dismiss="modal">Tạo Đề</button>
																	</div>																	
																</div>
															</div>
														</div>
													
												</div>
												<div class="modal-footer">													 
													<ul class="nav nav-pills" style="float:right">
														<li class="active"><button href="#tab1" class="btn btn-primary" data-toggle='tab'><span class="glyphicon glyphicon-arrow-left"></span></a></li>
														<li><button href="#tab2" class="btn btn-primary" data-toggle='tab'><span class="glyphicon glyphicon-arrow-right"></span></a></li>
													</ul>
												</div>
											</div>	  
										</div>
									</div>
								{!! Form::close() !!}
								{!! Form::open(array('route' => 'test.to.folder', 'method' => 'POST', 'class' => 'inline', 'id' => 'form-test', 'files' => 'true' )) !!}
									<div class="modal fade" id="modal_test" role="dialog">											
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
													  <button type="button" class="close" data-dismiss="modal">&times;</button>
													  <h4 class="modal-title">Thông tin bổ sung</h4>
													</div>
													<div class="modal-body">																	
													<div class="row">
														<div id="list_file2">
																	
														</div>
														<br/>
														<div class="row">
															<label>Số lượng câu hỏi mỗi đề:&nbsp;<span id="total_question2" style="color:red"></span></label>
															<input type="hidden" name="ipt_total_question" id="ipt_total_question2" value='' />
														</div>																		
													</div>														
													</div>
													<div class="modal-footer">													 
														<div class="row">
															<button type="submit" class="btn btn-primary" id="testing" data-dismiss="modal">Tạo bài kiểm tra</button>
														</div>
													</div>
												</div>	  
											</div>
										</div>
								{!! Form::close() !!}
						</div>						
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<table style="width:100%">
					<tr style="background-color:#E6F1F6;">
						<td colspan="2" style="font-size:12px;"><b style="color:#9E9E9E">THÀNH VIÊN</b>&nbsp;<a <?php if($data['user_group'][0]['role_group']==3){?> href="group/member?id=<?php echo $data['folder'][0]['id'] ?>" <?php }else{ ?> href ="#" <?php } ?> style="float:right;"><?php echo count($data['user_group']) ?> Thành viên</a></td>
					</tr>
					<?php foreach($data['user_group'] as $value){ ?>
					<tr>
						<td style="text-align:center;width:20%"><a href="#"><?php if($value['avata']!=''){ ?><img style="width:100%" src="{{asset('public/img/avata/'.$value['id'].'.jpg')}}"><?php }else{ ?><img style="width:100%" src="{{asset('public/img/avata/avata_default.jpg')}}"><?php } ?></a></td>
						<td><a href="#"><?php echo $value['fullname'] ?></a></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Tạo thư mục</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(array('route'=>'add.folder','method' => 'POST','id'=>'frm_newfolder')) !!}
					<div class="row">
						<label>Folder name:</label>
					</div>
					<div class="row">
						<input type="text" name="name" class="form-control" value="" />
						<input type="hidden" name="parent" class="form-control" value="<?php echo $data['folder'][0]['id'] ?>" />
						<input type="hidden" name="level" class="form-control" value="<?php echo $data['folder'][0]['level'] ?>" />
						<input type="hidden" name="categories" class="form-control" value="0" />	
						<input type="hidden" name="share" class="form-control" value="<?php echo $data['folder'][0]['share'] ?>" />						
					</div>	
				{!! Form::close() !!}
			</div>
			<div class="modal-footer">
			  <button type="submit" class="btn btn-primary" id="submit" data-dismiss="modal">Submit</button>
			</div>
		</div>
	  
	</div>
</div>
<div class="modal fade" id="addfile" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Tạo file mới</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(array('route'=>'add.folder','method' => 'POST','id'=>'frm_newfile')) !!}
					<div class="row">
						<label>Tên file:</label>
					</div>
					<div class="row">
						<input type="text" name="name" class="form-control" value="" />
						<input type="hidden" name="parent" class="form-control" value="<?php echo $data['folder'][0]['id'] ?>" />
						<input type="hidden" name="level" class="form-control" value="<?php echo $data['folder'][0]['level'] ?>" />
						<input type="hidden" name="categories" class="form-control" value="1" />
						<input type="hidden" name="share" class="form-control" value="<?php echo $data['folder'][0]['share'] ?>" />
					</div>					
				{!! Form::close() !!}
			</div>
			<div class="modal-footer">
			  <button type="submit" class="btn btn-primary" id="submit_file" data-dismiss="modal">Submit</button>
			</div>
		</div>
	  
	</div>
</div>
<div class="modal fade" id="modalinvite" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Thêm thành viên</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(array('route'=>'invite','method' => 'POST','id'=>'frm_invite')) !!}
					<div class="row">
						<label>Email thành viên:</label>
					</div>
					<div class="row">
						<input type="text" name="email" class="form-control" value="" />
						<input type="hidden" name="group_id" class="form-control" value="<?php echo $data['folder'][0]['id'] ?>" />
						<input type="hidden" name="group_name" class="form-control" value="<?php echo $data['folder'][0]['name'] ?>" />
					</div>					
				{!! Form::close() !!}
			</div>
			<div class="modal-footer">
			  <button type="submit" class="btn btn-primary" id="submit_invite" data-dismiss="modal">Thêm</button>
			</div>
		</div>	  
	</div>
</div>
<div class="modal fade" id="groupsetting" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Chỉnh sửa thông tin nhóm</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(array('route'=>'groupsetting','method' => 'POST','id'=>'frm_setting')) !!}
					<div class="row">
						<label>Tên nhóm:</label>
					</div>
					<div class="row">
						<input type="text" name="name" class="form-control" value="" />
						<input type="hidden" name="id" class="form-control" value="<?php echo $data['folder'][0]['id'] ?>" />
					</div>					
				{!! Form::close() !!}
			</div>
			<div class="modal-footer">
			  <button type="submit" class="btn btn-primary" id="submit_setting" data-dismiss="modal">Submit</button>
			</div>
		</div>
	  
	</div>
</div>
@endsection