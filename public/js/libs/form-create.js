$(function(){
	$('form').submit(function(e){
		e.preventDefault();

		var that = $(this);
		var buttonSubmit = that.find('button:submit');
		var textButtonSubmit = buttonSubmit.text();

		that.find('button:submit')
			.addClass('disabled')
			.text('Loading...');

		$.ajax({
			type: that.attr('method'),
			url: that.attr('action'),
			data: that.serialize(),
			success: function(result){
				if(result.urlRedirect != null){
					window.location = result.urlRedirect;
				}else{
					window.location = '';
				}
			},
			error: function(result){
				var spanOpen = '<span id="error" class="help-block">';
				var spanClose = '</span>';
				var spanContent = '';

				if(result.status == 422){

					$('form div.form-group').each(function(key, value){
						$(this).removeClass('has-error');
						$(this).find('span#error').remove('span#error');
					});

					$.each(result.responseJSON, function(key, value){
						$.each(value, function(responseKey, responseError){
							spanContent += responseError + ' ';
						});

						$('form div#' + key)
							.addClass('has-error')
							.append(spanOpen + spanContent + spanClose);

						spanContent = '';
					});
				}

				that.find('button:submit')
					.removeClass('disabled')
					.text(textButtonSubmit);
			}
		});

		return false;
	});
});