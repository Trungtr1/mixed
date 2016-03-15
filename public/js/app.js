$(document).on('click','#testing',function(){
		$('#form-test').submit();
})
$(document).on('click','#mixed',function(){
	$('#mix-question-form').submit();
})
$(document).on('click','#add_group',function(){
	$('#frm_addGroup').submit();
})
$(document).on('click','#submit',function(){
	$('#frm_newfolder').submit();
})
$(document).on('click','#submit_file',function(){
	$('#frm_newfile').submit();
})	
$(document).on('click','#cutting',function(){
	$objects = $('#objects').val();
	$('.cht').each(function(){
		if(this.checked==true){
			$objects = $objects+" "+$(this).val();
		}
	})
	$('#objects').val($objects);
})
$(document).on('click','#btn-mix',function(){
	var $total_questions=0;
	$('#list_file').empty();
	$('.file').each(function(){
		if(this.checked==true){
			var $file_id = $(this).val();
			var $file_name=$(this).attr('data-name');
			var $file_cques=parseInt($(this).attr('data-cques'));
			$total_questions=$total_questions+$file_cques;
			if($file_cques>0)
			{
				$file ="";
				$file+= "<div class='row'>";
				$file+= 	"<label>Số câu hỏi từ file "+$file_name+" :</label>";
				$file+=		"<input type='checkbox' name='file[]' value='"+$file_id+"' checked='true' hidden/>";
				$file+= "</div>";
				$file+= "<div class='row'>";
				$file+= 	"<input type='text' class='form-control nbq' name='number_questions[]' value='"+$file_cques+"' placeholder='Tối đa "+$file_cques+"' onblur='change_number()'/>";
				$file+= "</div>";
				$file+= "<br/>";
				$('#list_file').append($file);
			}					
		}
	})
	$('#total_question').text($total_questions);
	$('#ipt_total_question').val($total_questions);	
})

function change_number()
{
	var $total_questions=0;
	$('.nbq').each(function(){
		var $number_questions=parseInt($(this).val());
		$total_questions=$total_questions+$number_questions;
	})
	$('#total_question').text($total_questions);
	$('#ipt_total_question').val($total_questions);
}

$(document).on('click','#btn-test',function(){
	var $total_questions=0;
	$('#list_file2').empty();
	$('.file').each(function(){
		if(this.checked==true){
			var $file_id = $(this).val();
			var $file_name=$(this).attr('data-name');
			var $file_cques=parseInt($(this).attr('data-cques'));
			$total_questions=$total_questions+$file_cques;
			if($file_cques>0)
			{
				$file ="";
				$file+= "<div class='row'>";
				$file+= 	"<label>Số câu hỏi từ file "+$file_name+" :</label>";
				$file+=		"<input type='checkbox' name='file[]' value='"+$file_id+"' checked='true' hidden/>";
				$file+= "</div>";
				$file+= "<div class='row'>";
				$file+= 	"<input type='text' class='form-control nbq2' name='number_questions[]' value='"+$file_cques+"' placeholder='Tối đa "+$file_cques+"' onblur='change_number2()'/>";
				$file+= "</div>";
				$file+= "<br/>";
				$('#list_file2').append($file);
			}					
		}
	})
	$('#total_question2').text($total_questions);
	$('#ipt_total_question2').val($total_questions);	
})

function change_number2()
{
	var $total_questions=0;
	$('.nbq2').each(function(){
		var $number_questions=parseInt($(this).val());
		$total_questions=$total_questions+$number_questions;
	})
	$('#total_question2').text($total_questions);
	$('#ipt_total_question2').val($total_questions);
}

function goBack() {
	window.history.back();
}

$(document).ready(function(){
	
	if ($('.dt').length > 0) {
	
		$('.dt').DataTable();
	
	}
	
	$('.sequence-input').blur(function(){
		$(this).val($(this).val().trim().replace(/(\s|\r\n|\n|\r)/gm,""));
	});

	$('form').submit(function(){
		return doValidate($(this));
	});
	
	// $('.jsubmit').click(function(){
		// doValidate($(this).parents('.jform'));
	// });

	function doValidate(form)
	{
		var t = form;
		if(t.find('.validate-control').length > 0)
		{
			t.find('.validate-control:enabled').each(function(){
				if ($(this).hasClass('validate-fasta')) {
					if (!validateFasta($(this).val())) {
						$(this).siblings('.text-error').text('Fasta Invalid').show();
					} else {
						$(this).siblings('.text-error').hide();
					}
				} else if ($(this).hasClass('validate-sequence')) {
					if (!validateSequence($(this).val())) {
						$(this).siblings('.text-error').text('Sequence Invalid').show();
					} else {
						$(this).siblings('.text-error').hide();
					}	
				} else if ($(this).hasClass('validate-nu-sequence')) {
					if (!validateNuSequence($(this).val())) {
						$(this).siblings('.text-error').text('Nucleotide Sequence Invalid').show();
					} else {
						$(this).siblings('.text-error').hide();
					}
				}		
			});
			if (t.find('.text-error:visible').length>0) {
				return false;
			}
			return true;
		}
	}

	
});