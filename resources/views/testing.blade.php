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
		{!! Form::open(array('method' => 'POST','id' => 'frm-test', 'files' => 'true' )) !!}
		<div class="section1">
			<div style="text-align:left">
				<?php foreach($data['tests'] as $ts){ ?>
				<table class="table" style="width:100%">					
					<tr>
						<td>
							<h3 align="center">KIỂM TRA</h3>
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
			</div>	
		</div>
		<div>
			<div style="margin-top:10px;">
					<input type="hidden" name="number_questions" value="<?php echo $data['tests'][0]['number_questions'] ?>" />
					<input type="hidden" name="test_id" value="<?php echo $data['tests'][0]['id'] ?>" />
					<input type="submit" name="submit" style="height:40px;width:200px;" value="Nộp bài" />
			</div>
		</div>
		{!! Form::close() !!}
		<br>
		<br>
	</div>
</body>
<html>