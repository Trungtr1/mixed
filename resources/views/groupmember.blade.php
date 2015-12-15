@extends('templates.master')

@section('title', 'Home')

@section('content')
<div class="container">
	<div class="content">
		<div class="row">
			<div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
				<div class="col-lg-12 col-md-12">
					<br>
					<div class="row" style="text-align: justify;">
						<table style="width:100%" class="table table-bordered">
							<tr style="background-color:#F6F7F8;">
								<td style="width:50%;padding:5px;border-right:0px;"><?php echo $data['count'] ?> thành viên</td>
								<td style="width:50%;padding:5px;border-left:0px;">
									{!! Form::open(array('route'=>'invite','method' => 'POST','id'=>'frm_invite','style'=>'float:right;margin-bottom:0px;')) !!}
									<input type="text"name="email" value="" placeholder=" thêm thành viên"/>
									<input type="hidden" name="group_id" class="form-control" value="<?php echo $data['folder'][0]['id'] ?>" />
									<input type="hidden" name="group_name" class="form-control" value="<?php echo $data['folder'][0]['name'] ?>" />
									<button type="submit" id="submit_invite" data-dismiss="modal">Thêm</button>
									{!! Form::close() !!}
								</td>
							</tr>
							<?php for($i=0;$i<=$data['count']-1;$i=$i+2){ ?>
							<tr>
								<td>
									<?php if(isset($data['user_group'][$i])){ ?>
									<table class="table table-bordered" style="margin:0px;">
										<tr>
											<td style="text-align:center;width:25%;border:0px;padding:0px;"><a href="#"><?php if($data['user_group'][$i]['avata']!=''){ ?><img style="width:100%" src="{{asset('public/img/avata/'.$data['user_group'][$i]['id'].'.jpg')}}"><?php }else{ ?><img style="width:100%" src="{{asset('public/img/avata/avata_default.jpg')}}"><?php } ?></a></td>
											<td style="border-right:0px;">
												<a href="#"><b><?php echo $data['user_group'][$i]['fullname'] ?></b></a><br/>
												<p>
													<?php echo $data['user_group'][$i]['address'] ?><br/>
													<?php echo $data['user_group'][$i]['email'] ?><br/>
												<p>												
											</td>
											<td style="border-left:0px;">
												<div class="dropdown" align="center">
												  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<span class="glyphicon glyphicon-cog"></span>
												  </button>
												  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="text-align:left">
													<?php if($data['user_group'][$i]['id']==$data['user'][0]['id']){ ?>
														<li><a href="/outgroup?id=<?php echo $data['folder'][0]['id'] ?>">Rời khỏi nhóm</a></li>
													<?php }else{ ?>
														<?php if($data['user_group'][$i]['role_group']==3){ ?>
															<li><a>Quản trị viên</a></li>															
														<?php }else{ ?>
															<li><a href="/group/member/changerole?id=<?php echo $data['user_group'][$i]['id'] ?>&group=<?php echo $data['folder'][0]['id'] ?>">Chỉ định làm quản trị viên</a></li>
															<li><a href="/group/member/kick?id=<?php echo $data['user_group'][$i]['id'] ?>&group=<?php echo $data['folder'][0]['id'] ?>">Loại bỏ khỏi nhóm</a></li>
														<?php } ?>
													<?php } ?>
												  </ul>
												</div>
											</td>
										</tr>
									</table>
									<?php } ?>
								</td>
								<?php $k=$i+1 ?>								
								<td>
									<?php if(isset($data['user_group'][$k])){ ?>
									<table class="table table-bordered" style="margin:0px;">
										<tr>
											<td style="text-align:center;width:25%;border:0px;padding:0px;"><a href="#"><?php if($data['user_group'][$k]['avata']!=''){ ?><img style="width:100%" src="{{asset('public/img/avata/'.$data['user_group'][$k]['id'].'.jpg')}}"><?php }else{ ?><img style="width:100%" src="{{asset('public/img/avata/avata_default.jpg')}}"><?php } ?></a></td>
											<td style="border-right:0px;">
												<a href="#"><b><?php echo $data['user_group'][$k]['fullname'] ?></b></a><br/>
												<p>
													<?php echo $data['user_group'][$k]['address'] ?><br/>
													<?php echo $data['user_group'][$k]['email'] ?><br/>
												</p>
											</td>
											<td style="text-align:center;border-left:0px;">
												<div class="dropdown" align="center">
												  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<span class="glyphicon glyphicon-cog"></span>
												  </button>
												  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="text-align:left">
													<?php if($data['user_group'][$k]['id']==$data['user'][0]['id']){ ?>
														<li><a href="/outgroup?id=<?php echo $data['folder'][0]['id'] ?>">Rời khỏi nhóm</a></li>
													<?php }else{ ?>
														<?php if($data['user_group'][$k]['role_group']==3){ ?>
															<li><a>Quản trị viên</a></li>															
														<?php }else{ ?>
															<li><a href="/group/member/changerole?id=<?php echo $data['user_group'][$k]['id'] ?>&group=<?php echo $data['folder'][0]['id'] ?>">Chỉ định làm quản trị viên</a></li>
															<li><a href="/group/member/kick?id=<?php echo $data['user_group'][$k]['id'] ?>&group=<?php echo $data['folder'][0]['id'] ?>">Loại bỏ khỏi nhóm</a></li>
														<?php } ?>
													<?php } ?>
												  </ul>
												</div>
											</td>
										</tr>
									</table>
									<?php } ?>
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
<script>
	$(document).on('click','#submit_invite',function(){
		$('#frm_invite').submit();
	})
</script>
@endsection