<!-- Jquery -->
<script src="/js/jquery-1.10.2.min.js"></script>

<!-- Bootstrap -->
<script src="/bootstrap/js/bootstrap.js"></script>

<!-- Datatable -->
<script src='/js/jquery.dataTables.min.js'></script>	

<!-- Colorbox -->
<script src='/js/jquery.colorbox.min.js'></script>	

<!-- Sparkline -->
<script src='/js/jquery.sparkline.min.js'></script>

<!-- Pace -->
<script src='/js/uncompressed/pace.js'></script>

<!-- Popup Overlay -->
<script src='/js/jquery.popupoverlay.min.js'></script>

<!-- Slimscroll -->
<script src='/js/jquery.slimscroll.min.js'></script>

<!-- Modernizr -->
<script src='/js/modernizr.min.js'></script>

<!-- Cookie -->
<script src='/js/jquery.cookie.min.js'></script>

<!-- Endless -->
<script src="/js/endless/endless.js"></script>

<script src="/js/sweetalert.min.js"></script> 
<script>
	
		$(function(){
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });
		});
</script>
@if(session()->has('flash_message'))
	<script>
		swal({
			title: "{!! session()->get('flash_message.title') !!}",
			text: "{!! session()->get('flash_message.message') !!}",
			type: "{!! session()->get('flash_message.level') !!}",
			timer: 3000,
			showConfirmButton: false
		});
	</script>
@endif