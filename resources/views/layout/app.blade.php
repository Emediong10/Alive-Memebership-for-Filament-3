<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">

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

    <style>

		.mfp-close { display: none !important; }

	</style>

</head>

<body class="stretched">

	<!-- Header
		============================================= -->
		{{-- @include('layouts.nav') --}}
	

        @yield('content')



		<!-- Footer
		============================================= -->


            {{-- @include('layout.footer') --}}


        <!-- #footer end -->



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
		jQuery(document).ready( function(){

			var element = $(".custom-file");

			element.find('input[type="file"]').change(function(e){
				var fileName = e.target.files[0].name;
				element.find('.custom-file-label').html(fileName);
			});

			$('#template-contactform').on( 'formSubmitSuccess', function(){
				setTimeout(function(){
 					$('#block-modal-request').magnificPopup('close');
  				}, 500);
			});

		});
	</script>

</body>
</html>
