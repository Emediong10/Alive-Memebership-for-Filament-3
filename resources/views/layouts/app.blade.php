<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900&display=swap" rel="stylesheet" type="text/css" />
	



	<link rel="stylesheet" href="{{asset ('assets/css/bootstrap.css')}}" type="text/css"/>
	<link rel="stylesheet" href="{{ asset ('assets/style.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('assets/css/swiper.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('assets/css/dark.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset ('assets/css/font-icons.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset ('assets/css/animate.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('assets/css/components/bs-switches.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset ('assets/css/magnific-popup.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset ('css/wizard.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset ('css/step.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="stylesheet" href="{{ asset('assets/css/colors.php?color=209EBB') }}" type="text/css" />

	<link rel="stylesheet" href="{{asset ('assets/css/colors.php?color=FE9603')}}" type="text/css" /> <!-- Theme Color -->
	<link rel="stylesheet" href="{{ asset ('assets/demos/seo/css/fonts.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset ('assets/demos/seo/seo.css') }}" type="text/css" />
<!-- Link to Tailwind CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

	<!-- Document Title
	============================================= -->
	<title>Alive_form</title>
</head>
<body class="stretched">
<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->
		
    @yield('body')

</div>

<!-- JavaScripts
	============================================= -->
	<script src="{{asset('assets/js/jquery.js')}}"></script>
	<script src="{{asset('assets/js/plugins.min.js')}}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{asset('assets/js/functions.js')}}"></script>
    <script src="{{asset('js/step.js')}}"></script>
	
	<script src="{{ asset ('assets/js/particles/particles.min.js')}}"></script>
	<script src="{{ asset ('assets/js/particles/particles-line.js')}}"></script><!-- Particles Line -->


	<script src="{{asset('assets/js/functions.js')}}"></script>

	<script>
		jQuery(document).ready(function($){
			var $faqItems = $('#faqs .faq');
			if( window.location.hash != '' ) {
				var getFaqFilterHash = window.location.hash;
				var hashFaqFilter = getFaqFilterHash.split('#');
				if( $faqItems.hasClass( hashFaqFilter[1] ) ) {
					$('.grid-filter li').removeClass('activeFilter');
					$( '[data-filter=".'+ hashFaqFilter[1] +'"]' ).parent('li').addClass('activeFilter');
					var hashFaqSelector = '.' + hashFaqFilter[1];
					$faqItems.css('display', 'none');
					if( hashFaqSelector != 'all' ) {
						$( hashFaqSelector ).fadeIn(500);
					} else {
						$faqItems.fadeIn(500);
					}
				}
			}

			$('.grid-filter a').on( 'click', function(){
				$('.grid-filter li').removeClass('activeFilter');
				$(this).parent('li').addClass('activeFilter');
				var faqSelector = $(this).attr('data-filter');
				$faqItems.css('display', 'none');
				if( faqSelector != 'all' ) {
					$( faqSelector ).fadeIn(500);
				} else {
					$faqItems.fadeIn(500);
				}
				return false;
		   });
		});
	</script>

</body>
</html>
