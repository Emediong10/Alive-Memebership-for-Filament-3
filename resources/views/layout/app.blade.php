<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ url('new/css/bootstrap.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ url('new/style.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ url('new/css/dark.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ url('new/css/swiper.css') }}" type="text/css" />

	<!-- Crowdfunding Demo Specific Stylesheet -->
	<link rel="stylesheet" href="{{ url('new/demos/crowdfunding/crowdfunding.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ url('new/demos/crowdfunding/css/fonts.css') }}" type="text/css" />
	<!-- / -->

	<link rel="stylesheet" href="{{ url('new/css/font-icons.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ url('new/css/animate.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ url('new/css/magnific-popup.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ url('new/css/custom.css') }}" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="stylesheet" type="text/css" href="include/rs-plugin/css/settings.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="include/rs-plugin/css/layers.css">
	<link rel="stylesheet" type="text/css" href="include/rs-plugin/css/navigation.css">

	<link rel="stylesheet" href="{{ url('new/css/colors.php?color=209EBB') }}" type="text/css" />

	<!-- Document Title
	============================================= -->
	<title>ALIVE Nigeria</title>

</head>

<body class="stretched">

	<!-- Header
		============================================= -->
		{{-- @include('layouts.nav') --}}
		<br><br>

        @yield('content')



		<!-- Footer
		============================================= -->
		{{-- <footer id="footer" class="dark" style="background-color: #0d2706"> --}}

            {{-- @include('layout.footer') --}}

		{{-- </footer> --}}
        <!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-line-arrow-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="{{ url('new/js/jquery.js') }}"></script>
	<script src="{{ url('new/js/plugins.min.js') }}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{ url('new/js/functions.js') }}"></script>

	<!-- ADD-ONS JS FILES -->
	<script>



	</script>

</body>
</html>
