<?php
	/*
	header("Pragma: public"); // required
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private", false); // required for certain browsers
	header("Content-Transfer-Encoding: binary");
	header('Content-Type: application/msword; charset=UTF-8');
	header("Content-Type: application/force-download");
	header("Content-Type: application/download");
	header("Content-Disposition: attachment; filename=test.doc");
	header("Content-Transfer-Encoding: binary");
	*/
?>
<html>
<style>
	.section1{
		width:840px;
		padding:10px 50px 10px 50px;
		border:3px double #000;
	}
	.bold{
		font-size: 14pt;
	}
</style>
<body>
	<div align="center">
		<div class="section1">
			<div style="text-align:left">
				<?php foreach($data['tests'] as $ts){ ?>
				<table class="table" style="width:100%">
					<tr>
						<td>
							<table class="table" style="width:100%">
								<tr>
									<td style="width:40%;vertical-align: top;">
										<b class="bold"><?php echo $ts['school'] ?></b>
									</td>
									<td style="text-align:center">
										<b class="bold"><?php echo $ts['title'] ?></b><br>
										<b class="bold">Môn: <?php echo $ts['subject'] ?></b><br>
										Thời gian: <?php echo $ts['time'] ?> phút<br>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<span style="color:#142CAB">
								Họ tên học sinh:.........................................................................................
								SBD:................................
								Lớp:..................
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<i>
								<b style="color:#142CAB">
									Học sinh giải các bài toán hay trả lời ngắn gọn các câu hỏi vào các dòng trống tương ứng của từng câu (Nhớ ghi rõ đơn vị các đại lượng đã tính).
								</b>
							</i>
						</td>
					</tr>
					<tr>
						<td>
							<table class="table" style="width:100%;">
								<?php for($i=1;$i<=ceil(count($data['questions'][$ts['id']])/4);$i++){ ?>
									<tr>
										<td>
											<?php echo 4*($i-1)+1; ?>.<?php if((4*($i-1)+1)<10){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }else{if((4*($i-1)+1)<100){ ?>&nbsp;&nbsp;<?php }?><?php } ?>
											&#9398;&nbsp
											&#9399;&nbsp
											&#9400;&nbsp
											&#9401;
										</td>
										<td>
											<?php echo 4*($i-1)+2; ?>.<?php if((4*($i-1)+2)<10){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }else{if((4*($i-1)+2)<100){ ?>&nbsp;&nbsp;<?php }?><?php } ?>
											&#9398;&nbsp
											&#9399;&nbsp
											&#9400;&nbsp
											&#9401;
										</td>
										<td>
											<?php echo 4*($i-1)+3; ?>.<?php if((4*($i-1)+3)<10){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }else{if((4*($i-1)+3)<100){ ?>&nbsp;&nbsp;<?php }?><?php } ?>
											&#9398;&nbsp
											&#9399;&nbsp
											&#9400;&nbsp
											&#9401;
										</td>
										<td>
											<?php echo 4*($i-1)+4; ?>.<?php if((4*($i-1)+4)<10){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }else{if((4*($i-1)+4)<100){ ?>&nbsp;&nbsp;<?php }?><?php } ?>
											&#9398;&nbsp
											&#9399;&nbsp
											&#9400;&nbsp
											&#9401;
										</td>
									</tr>
								<?php } ?>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<div style="margin-top:20px; border:2px solid #000;width:120px;padding:5px 10px 5px 10px">
								<b class="bold">Mã đề: <?php echo $ts['code'] ?></b>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div style="margin-top:10px;">
								<?php foreach($data['questions'][$ts['id']] as $key=>$qs){ ?>
									<div class="row" style="margin-top:5px;">
										<b>Câu <?php echo $key+1 ?>:</b> <?php echo $qs['content'] ?>
									</div>
									<?php foreach($data['answers'][$ts['id']][$qs['id']] as $ans){ ?>
										<div class="row">
											<?php if($ans['order']==0){ echo "A.";} ?>
											<?php if($ans['order']==1){ echo "B.";} ?>
											<?php if($ans['order']==2){ echo "C.";} ?>
											<?php if($ans['order']==3){ echo "D.";} ?>
											<?php if($ans['order']==4){ echo "E.";} ?>
											<?php echo $ans['content'] ?>
										</div>
									<?php } ?>		
								<?php } ?>
							</div>
						</td>
					</tr>									
				</table>
				<br clear="all" style="page-break-before:always" />
				<table style="width:100%">
					<tr>
						<td>
							<div style="margin:10px 0px 10px 0px;">
								<b class="bold">Đáp án đề: <?php echo $ts['code'] ?></b>
							</div>
						</td>
					</tr>
					<?php for($i=1;$i<=ceil(count($data['questions'][$ts['id']])/4);$i++){ ?>
						<tr>
							<td>
								<?php echo 4*($i-1)+1; ?>.<?php if((4*($i-1)+1)<10){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }else{if((4*($i-1)+1)<100){ ?>&nbsp;&nbsp;<?php }?><?php } ?>
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)]) && $data['correct'][$ts['id']][4*($i-1)]==0){ ?>&#9398;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)]) && $data['correct'][$ts['id']][4*($i-1)]==1){ ?>&#9399;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)]) && $data['correct'][$ts['id']][4*($i-1)]==2){ ?>&#9400;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)]) && $data['correct'][$ts['id']][4*($i-1)]==3){ ?>&#9401;<?php }else{ ?>&#9711;<?php } ?>
							</td>
							<td>
								<?php echo 4*($i-1)+2; ?>.<?php if((4*($i-1)+2)<10){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }else{if((4*($i-1)+2)<100){ ?>&nbsp;&nbsp;<?php }?><?php } ?>
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+1]) && $data['correct'][$ts['id']][4*($i-1)+1]==0){ ?>&#9398;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+1]) && $data['correct'][$ts['id']][4*($i-1)+1]==1){ ?>&#9399;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+1]) && $data['correct'][$ts['id']][4*($i-1)+1]==2){ ?>&#9400;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+1]) && $data['correct'][$ts['id']][4*($i-1)+1]==3){ ?>&#9401;<?php }else{ ?>&#9711;<?php } ?>
							</td>
							<td>
								<?php echo 4*($i-1)+3; ?>.<?php if((4*($i-1)+3)<10){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }else{if((4*($i-1)+3)<100){ ?>&nbsp;&nbsp;<?php }?><?php } ?>
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+2]) && $data['correct'][$ts['id']][4*($i-1)+2]==0){ ?>&#9398;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+2]) && $data['correct'][$ts['id']][4*($i-1)+2]==1){ ?>&#9399;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+2]) && $data['correct'][$ts['id']][4*($i-1)+2]==2){ ?>&#9400;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+2]) && $data['correct'][$ts['id']][4*($i-1)+2]==3){ ?>&#9401;<?php }else{ ?>&#9711;<?php } ?>
							</td>
							<td>
								<?php echo 4*($i-1)+4; ?>.<?php if((4*($i-1)+4)<10){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }else{if((4*($i-1)+4)<100){ ?>&nbsp;&nbsp;<?php }?><?php } ?>
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+3]) && $data['correct'][$ts['id']][4*($i-1)+3]==0){ ?>&#9398;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+3]) && $data['correct'][$ts['id']][4*($i-1)+3]==1){ ?>&#9399;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+3]) && $data['correct'][$ts['id']][4*($i-1)+3]==2){ ?>&#9400;<?php }else{ ?>&#9711;<?php } ?>&nbsp
								<?php if(isset($data['correct'][$ts['id']][4*($i-1)+3]) && $data['correct'][$ts['id']][4*($i-1)+3]==3){ ?>&#9401;<?php }else{ ?>&#9711;<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</table>
				<br clear="all" style="page-break-before:always" />
				<?php } ?>
			</div>	
		</div>
		<div>
			<div style="margin-top:10px;">
				{!! Form::open(array('method' => 'POST','id' => 'frm-test', 'files' => 'true' )) !!}
					<input type="hidden" name="test_id" value="<?php echo $data['tests'][0]['id'] ?>" />
					<input type="submit" name="submit" style="height:40px;width:200px;" value="DOWNLOAD" />
				{!! Form::close() !!}
			</div>
		</div>
		<br>
		<br>
	</div>
</body>
<html>