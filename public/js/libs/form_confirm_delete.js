
$(function(){
	$('table form').submit(function(e){

		var that = $(this);

		swal({   
			title: that.attr('data-title-confirm'),   
			text: that.attr('data-message-confirm'),   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: that.attr('data-confirm-ok'),   
			cancelButtonText: that.attr('data-confirm-cancel'),   
			closeOnConfirm: false,   
			closeOnCancel: false }, 
			function(isConfirm){   
				if (isConfirm) {     
					$.ajax({
						type: that.attr('method'),
						url: that.attr('action'),
						data: that.serialize(),

						success:function(data){
							if(data.status){
								// swal(data.title, data.message, "success");

								swal({   
									title: data.title,   
									text: data.message,
									type: "success",   
									timer: 3000,   
									showConfirmButton: false 
								});

								setTimeout(function(){
									location.reload();
								}, 2000);
							}else{
								swal({   
									title: data.title,   
									text: data.message,
									type: "error",   
									timer: 3000,   
									showConfirmButton: false 
								});
							}
						}
					});
				} else {     
					swal({   
						title: that.attr('data-title-confirm'),   
						text: that.attr('data-message-cancel'),
						type: "error",   
						timer: 3000,   
						showConfirmButton: false 
					});

					setTimeout(function(){
						location.reload();
					}, 2000);
				} 
			});
		e.preventDefault();
	});
}); 