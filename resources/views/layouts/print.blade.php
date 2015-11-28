<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mixed System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	
	@section('style')
    	@include('layouts.partial.style')
    @show
    
  </head>

  <body class="overflow-hidden">
  
	<div id="overlay" class="transparent"></div>

	<div id="wrapper" class="preload">

		@include('layouts.partial.top_nav')
		
		@include('layouts.partial.side_bar')

		<div id="main-container">
			<div class="padding-md">
				@yield('content')
			</div><!-- /.padding-md -->
		</div><!-- /main-container -->
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
	    @include('layouts.partial.script')
	@show
  </body>
</html>
