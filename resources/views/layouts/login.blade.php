<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap//css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Font Awesome -->
	<link href="/css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Endless -->
	<link href="/css/endless.min.css" rel="stylesheet">

  </head>

  <body>
	<div class="login-wrapper">
		<div class="text-center">
			<h2 class="fadeInUp animation-delay8" style="font-weight:bold">
				<span class="text-success">Mixed</span> <span style="color:#ccc; text-shadow:0 1px #fff">System</span>
			</h2>
		</div>
		@yield('content')
	</div><!-- /login-wrapper -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <!-- Jquery -->
	<script src="/js/jquery-1.10.2.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
   
	<!-- Modernizr -->
	<script src='/js/modernizr.min.js'></script>
   
    <!-- Pace -->
	<script src='/js/pace.min.js'></script>
   
	<!-- Popup Overlay -->
	<script src='/js/jquery.popupoverlay.min.js'></script>
   
    <!-- Slimscroll -->
	<script src='/js/jquery.slimscroll.min.js'></script>
   
	<!-- Cookie -->
	<script src='/js/jquery.cookie.min.js'></script>

	<!-- Endless -->
	<script src="/js/endless/endless.js"></script>
  </body>
</html>
