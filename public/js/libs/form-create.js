$(function(){
	$('form').submit(function(e){
		e.preventDefault();

		var that = $(this);
        var formData = new FormData($(this)[0]);
		var buttonSubmit = that.find('button:submit');
		var textButtonSubmit = buttonSubmit.html();

        buttonSubmit.addClass('disabled')
        buttonSubmit.html(
                '<span class="fa fa-spinner fa-spin"></span> ' +
                'Loading...'
            );

		$.ajax({
			type: that.attr('method'),
			url: that.attr('action'),
			data: formData,
            async: false,
			success: function(result){
                console.log(result);
				if(result.status == 'success'){
					window.location = result.urlRedirect;
				}else{
					$('#response-errors').show(500);
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
					.html(textButtonSubmit);
			},
            cache: false,
            contentType: false,
            processData: false
		});

		return false;
	});
});