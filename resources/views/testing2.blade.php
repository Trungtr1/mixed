@extends('templates.master2')

@section('title', 'Group')

@section('content')

<div class="box">
	<div class="container">
		{!! Form::open(array('method' => 'POST','id' => 'frm-test', 'files' => 'true' )) !!}
		<div class="row"  style="border-style:double;padding:0px 50px 0px 50px;">
			<div style="text-align:left">
				<?php foreach($data['tests'] as $ts){ ?>
				<table class="table" style="width:100%">					
					<tr>
						<td>
							<h3 align="center" style="margin:10px;">KIỂM TRA</h3>
						</td>
					</tr>					
					<tr>
						<td>
							<div style="margin-top:10px;">
								<?php foreach($data['questions'][$ts['id']] as $key=>$qs){ ?>
									<div class="row" style="margin-top:5px;">
										<b>Câu <?php echo $key+1 ?>:</b> <?php echo $qs['content'] ?>
									</div>
									<?php foreach($data['answers'][$ts['id']][$qs['id']] as $key2=>$ans){ ?>
										<div class="row">
											<input type="radio" name="question_<?php echo $key ?>" value='<?php echo $key2 ?>' />
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
				<?php } ?>
				<div class="modal fade" id="modal_info" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							  <h4 class="modal-title">Nhập thông tin bổ sung</h4>
							</div>
							<div class="modal-body">
									<div class="row">
										<label>Thông tin người nộp bài:</label>
									</div>
									<div class="row">
										<input type="text" name="people_info" id="people_info" class="form-control" value="" />
										<input type="hidden" name="number_questions" value="<?php echo $data['tests'][0]['number_questions'] ?>" />
										<input type="hidden" name="test_id" value="<?php echo $data['tests'][0]['id'] ?>" />
									</div>
							</div>
							<div class="modal-footer">				
							  <button type="submit" class="btn btn-primary" id="submit_info" data-dismiss="modal">Gửi bài</button>
							</div>
						</div>	  
					</div>
				</div>
			</div>	
		</div>
		<div class="row">
			<div style="margin-top:10px;">
					<input type="hidden" name="number_questions" value="<?php echo $data['tests'][0]['number_questions'] ?>" />
					<input type="hidden" name="test_id" value="<?php echo $data['tests'][0]['id'] ?>" />
					<!--<input type="submit" name="submit" style="height:40px;width:200px;" value="Nộp bài" />-->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_info">Nộp bài</button>
			</div>
		</div>
		{!! Form::close() !!}
		<br>
		<br>
	</div>
</div>

<script>
	$(document).on('click','#submit_info',function(){
		$('#frm-test').submit();
	})
	$(document).on('click','#submit_invite',function(){
		$('#frm_invite').submit();
	})
</script>
@endsection