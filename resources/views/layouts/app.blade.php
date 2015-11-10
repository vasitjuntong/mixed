<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mixed System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    @include('layouts.partial.style')

    <style type="text/css">
		.shortcut-link-active{
		    color: #626262;
		    transition: color 0.2s ease;
		    -webkit-transition: color 0.2s ease;
		    -moz-transition: color 0.2s ease;
		    -ms-transition: color 0.2s ease;
		    -o-transition: color 0.2s ease;
		}
	</style>
    
  </head>

  <body class="overflow-hidden">
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>
	
	<a href="" id="theme-setting-icon"><i class="fa fa-cog fa-lg"></i></a>

	@include('layouts.partial.theme_setting')

	<div id="wrapper" class="preload">

		@include('layouts.partial.top_nav')
		
		@include('layouts.partial.side_bar')

		<div id="main-container">
			
			@yield('breadcrump')
			
			@include('layouts.partial.grey_container')
			
			<div class="padding-md">
				@yield('content')
			</div><!-- /.padding-md -->
		</div><!-- /main-container -->
		<!-- Footer
		================================================== -->
		<footer>
			<div class="row">
				<div class="col-sm-6">
					<span class="footer-brand">
						<strong class="text-danger">Mixed</strong> System
					</span>
					<p class="no-margin">
						&copy; 2015 <strong>Mixed System</strong>. ALL Rights Reserved. 
					</p>
				</div><!-- /.col -->
			</div><!-- /.row-->
		</footer>
		
		
		<!--Modal-->
		<div class="modal fade" id="newFolder">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Create new folder</h4>
      				</div>
				    <div class="modal-body">
				        <form>
							<div class="form-group">
								<label for="folderName">Folder Name</label>
								<input type="text" class="form-control input-sm" id="folderName" placeholder="Folder name here...">
							</div>
						</form>
				    </div>
				    <div class="modal-footer">
				        <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
						<a href="#" class="btn btn-danger btn-sm">Save changes</a>
				    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div><!-- /wrapper -->

	<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
	
	<!-- Logout confirmation -->
	<div class="custom-popup width-100" id="logoutConfirm">
		<div class="padding-md">
			<h4 class="m-top-none"> Do you want to logout?</h4>
		</div>

		<div class="text-center">
			<a class="btn btn-success m-right-sm" href="login.html">Logout</a>
			<a class="btn btn-danger logoutConfirm_close">Cancel</a>
		</div>
	</div>
	@section('script')
	    <!-- Le javascript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
		
		<!-- Jquery -->
		<script src="/js/jquery-1.10.2.min.js"></script>

		<!-- Bootstrap -->
	    <script src="/bootstrap/js/bootstrap.js"></script>
		
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
	@show
  </body>
</html>
