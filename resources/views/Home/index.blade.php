@extends('layout.app')
@section('content')
<!-- Slider
		============================================= -->
	<section id="slider" class="slider-element min-vh-100 include-header" style="background: url('new/demos/crowdfunding/images/hero.svg') no-repeat center bottom / cover;">
		<div class="slider-inner">

			<div class="vertical-middle">
				<div class="container py-5">
					<div class="row">
						<div class="col-lg-6 col-md-8">
							<div class="slider-title">
								<h1 class="fw-semibold">ALIVE-NIGERIA MEMBERSHIP PORTAL</h1>
								<p class="text-muted">Our mission is to prepare Africa for the imminent return of Jesus Christ through biblical spiritual training and evangelistic efforts. It is our goal to challenge African Seventh-day Adventist young adults to live a lifestyle of authentic biblical excellence, instill a missionary volunteer spirit in every African Seventh-day Adventist young adult, mobilize and support young adult missionary movements across Africa, create a meaningful impact in neglected areas, and finally change the continent of Africa by ushering in the imminent return of Jesus Christ.</p>
							</div>
							<a href="{{ route('registration') }}" class="button button-large fw-semibold button-rounded ls0 nott ms-0">Register Here</a>
							<a href="{{ url('admin/login') }}" target ="blank" class="button button-large fw-semibold button-border button-rounded ls0 nott">Sign In</a><br>
							<a href="{{ route('membership_standards') }}">Read Membership Standards here <i class="icon-caret-right1 position-relative" style="top: 2px"></i></a>
						</div>
		<img src="assets/images/welcome2.png" alt="" class="slider-img parallax;"  data-400="margin-top:40px;adeInRight" style="border-radius: 15px; padding-left:60px; width: 500px;">
					</div>
				</div>
			</div>

		</div>
	</section><!-- #Slider End -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap p-0">

				<div class="fancy-title title-border title-center mb-5">
						<h3>I WILL GO</h3>
					</div>
					<div class="center">
						<p>Join us today and lets get the good news of the gospel to places where no one wants to go!</p>
						</div>

					<div class="row justify-content-center col-mb-50 mb-5">
						<div class="col-md-6 col-lg-4">
							
							<div class="fslider"  data-direction="horizontal" data-pagi="false" data-arrows="false">
								<div class="flexslider">
									<div class="slider-wrap">
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic17.jpg')}}" alt="Slider 1"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic8.jpg')}}" alt="Slider 2"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic19.jpg')}}" alt="Slider 3"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic14.jpg')}}" alt="Slider 4"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic4.jpg')}}" alt="Slider 5"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic13.jpg')}}" alt="Slider 6"></div>

									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-4">
						<div class="fslider"  data-direction="horizontal" data-pagi="false" data-arrows="false">
								<div class="flexslider">
									<div class="slider-wrap">
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic1.jpg')}}" alt="Slider 1"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic2.jpg')}}" alt="Slider 2"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic7.jpg')}}" alt="Slider 3"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic5.jpg')}}" alt="Slider 4"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic15.jpg')}}" alt="Slider 5"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic13.jpg')}}" alt="Slider 6"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-4">
							<div class="fslider"  data-direction="horizontal" data-pagi="false" data-arrows="false">
								<div class="flexslider">
									<div class="slider-wrap">
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic11.jpg')}}" alt="Slider 1"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic.jpg')}}" alt="Slider 2"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic18.jpg')}}" alt="Slider 3"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic10.jpg')}}" alt="Slider 4"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic21.jpg')}}" alt="Slider 5"></div>
										<div class="slide"><img src="{{ asset ('assets/images/Alivepic6.jpg')}}" alt="Slider 6"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

			</div>
            <br>
            <br>
		</section> 
		
		<!-- #content end -->
@endsection
