$('document').ready(function(){
	$('#add_name').submit(function(){
		var abort = false;
		$('div.error').remove();
		$(':input[required]').each(function(){
			if($(this).val() === ''){
				$(this).after('<div class="error">This is a required field</div>');
				abort=true;
			}
		});//on each
		if(abort){return false;} else {return true;}
	})//on submit
});