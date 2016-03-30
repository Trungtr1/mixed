@extends('templates.master2')

@section('title', 'Chấm bài')

@section('content')

<div class="box">
	<div class="container">
		<div class="row"  style="border-style:double;padding:0px 50px 0px 50px;">
			<div style="text-align:left">
				<?php foreach($data['tests'] as $ts){ ?>
				<table class="table" style="width:100%">					
					<tr>
						<td style="text-align:center;">
							<h3 >Kết quả bài kiểm tra</h3>
							số câu đúng <?php echo $data['correct']; ?> / <?php echo $data['tests'][0]['number_questions'] ?>
						</td>
					</tr>					
					<tr>
						<td>
							<table style="margin-top:10px;width:100%">
								<?php foreach($data['questions'][$ts['id']] as $key=>$qs){ ?>
									<tr>
										<td></td>
										<td><b>Câu <?php echo $key+1 ?>:</b> <?php echo $qs['content'] ?></td>
									</tr>
									<?php foreach($data['answers'][$ts['id']][$qs['id']] as $key2=>$ans){ ?>									
									<tr>
										<td>
											<?php if($key2==$data['answers_correct'][$key]){?>
												&#9745;
											<?php }else{ ?>
												&#9744;
											<?php } ?>
										</td>
										<td>
											<input type="radio" name="question_<?php echo $key ?>" value='<?php echo $key2 ?>' <?php if($key2==$data['choose'][$key]){ echo "checked='true'"; } ?>/>
											<?php if($ans['order']==0){ echo "A.";} ?>
											<?php if($ans['order']==1){ echo "B.";} ?>
											<?php if($ans['order']==2){ echo "C.";} ?>
											<?php if($ans['order']==3){ echo "D.";} ?>
											<?php if($ans['order']==4){ echo "E.";} ?>
											<?php echo $ans['content'] ?>
										</td>
									</tr>
									<?php } ?>		
								<?php } ?>								
							</table>
						</td>
					</tr>									
				</table>				
				<?php } ?>
			</div>	
		</div>
		<br/>
		<div class="row">
			<div style="margin-top:10px;" align="center">
				<a href="/folder" style="padding:10px 20px 10px 20px;border:1px solid #ccc;text-decoration:none;">Trở về</a>
			</div>
		</div>
		<br>
		<br>
	</div>
</div>
@endsection