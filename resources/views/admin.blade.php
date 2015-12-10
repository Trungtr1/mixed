@extends('templates.master')

@section('title', 'Home')

@section('content')


<style>
	.list li{
		margin-top:10px;
	}
</style>
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="row" style="margin-top:20px;">
						<div class="col-lg-12 col-md-12">
							<div class="nav-tabs-custom" style="margin-bottom: 0px; box-shadow:none;">
								<ul class="nav nav-tabs">
								  <li class="active"><a href="#tab1" data-toggle='tab'>Quản lý người dùng</a></li>
								  <li><a href="#tab2" data-toggle='tab'>Quản lý nhóm</a></li>
								  <li><a href="#tab3" data-toggle='tab'>Messages</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:20px;">
						<div class="tab-content col-lg-12 col-md-12">
							<div class="tab-content col-sm-12" style="padding:0px;">
								<div class="tab-pane active" id="tab1">
									<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th style="width:180px">Họ tên</th>
												<th style="width:250px">Email</th>
												<th style="width:105px">Số điện thoại</th>
												<th>Địa chỉ</th>
												<th style="width:70px">Câu hỏi</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($data['ql_nguoidung'] as $ql){ ?>
												<tr>
													<td><?php echo $ql['fullname']; ?></td>
													<td><?php echo $ql['email']; ?></td>
													<td><?php echo $ql['phone']; ?></td>
													<td><?php echo $ql['address']; ?></td>
													<td style="text-align:right;"><?php if(!array_key_exists($ql['id'],$data['count_question'])){ echo '0'; }else{ echo $data['count_question'][$ql['id']]['count']; } ?></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tab2">
									
								</div>
								<div class="tab-pane" id="tab3">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
			$('#example').DataTable();
		} );
</script>
@endsection