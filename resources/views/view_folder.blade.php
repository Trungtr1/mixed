@extends('templates.master')

@section('title', 'Folder')

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
				<h3><button type="button" style="padding:12px;border-radius:20px;" class='btn btn-primary' onclick="goBack()"><span class="glyphicon glyphicon-arrow-left"></span></button>&nbsp;<?php echo $data['folder'][0]['name'] ?></h3>				
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
											<button type="button" title="sửa" name="sua" style="border:0px;background:none;">
												<span style="color:#428bca" class='glyphicon glyphicon-pencil'></span>
											</button>
											<a href="/folder?id=<?php echo $data['folder'][0]['id'] ?>&action=delete&folder_id=<?php echo $ch['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">
												<button type="button" title="xóa" name="xoa" style="border:0px;background:none;"><span style="color:#e44b23" class='glyphicon glyphicon-trash'></span></button>
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
											<button type="button" title="sửa" name="sua" style="border:0px;background:none;">
												<span style="color:#428bca" class='glyphicon glyphicon-pencil'></span>
											</button>
											<a href="/folder?id=<?php echo $data['folder'][0]['id'] ?>&action=delete&folder_id=<?php echo $fi['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">
												<button type="button" title="xóa" name="xoa" style="border:0px;background:none;"><span style="color:#e44b23" class='glyphicon glyphicon-trash'></span></button>
											</a>
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
@endsection