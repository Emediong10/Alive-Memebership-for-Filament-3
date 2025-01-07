@extends('layout.app')
@section('content')
@include('Home.pop-up')
<!-- Slider Section -->
<section id="slider" class="slider-element min-vh-100 include-header" style="background: url('new/demos/crowdfunding/images/watercolour.png') no-repeat center bottom / cover;">
    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Slider Inner Content -->
    <div class="slider-inner">
        <div class="container py-5">
            <div class="row">
                <!-- Content Column -->
                <div class="col-lg-6 col-md-8 position-relative" style="z-index: 20;">
                    <div class="slider-title">
                        <h1 class="fw-semibold center">ALIVE-NIGERIA MEMBERSHIP PORTAL</h1>
                        <div><strong>Our mission is to prepare Africa for the imminent return of Jesus Christ through biblical spiritual training and evangelistic efforts. It is our goal to challenge African Seventh-day Adventist young adults to live a lifestyle of authentic biblical excellence, instill a missionary volunteer spirit in every African Seventh-day Adventist young adult, mobilize and support young adult missionary movements across Africa, create a meaningful impact in neglected areas, and finally change the continent of Africa by ushering in the imminent return of Jesus Christ. </strong></div>
                    </div>
                    <br>
                    <!-- Buttons -->
                    <div>
                        <a href="{{ route('registration') }}" class="button button-success button-large fw-semibold button-rounded ls0 nott ms-0">Register Here</a>
                        <a href="{{ url('users/login') }}" target="_blank" class="button button-success button-large fw-semibold button-rounded ls0 nott ms-0">Sign In</a>
                        <br>
                        <a href="{{ route('membership_standards') }}" target="_blank" class="button button-success button-large fw-semibold button-rounded ls0 nott ms-0">Read Membership Standards here</a>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="col-md-4 center position-relative" style="z-index: 20;">
                    <img data-animate="fadeInLeft" src="assets/images/welcome2.png" alt="Welcome">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional Content Section -->
<section id="slider"  class="slider-element min-vh-100 include-header" style="background: url('new/demos/crowdfunding/images/watercolour.png') no-repeat center bottom / cover;">
    <div class="overlay"></div>
    <div class="content-wrap p-0 position-relative" style="z-index: 20;">
        <div class="fancy-title title-border title-center">
            <h1>I WILL GO</h1>
        </div>
        <div class="center">
            <strong>Join us today and let's get the good news of the gospel to places where no one wants to go!</strong>
        </div>
        <br>
        <!-- Slider Images -->
        <div class="row justify-content-center col-mb-50 mb-5">
            <div class="col-md-6 col-lg-4">
                <div class="fslider" data-direction="horizontal" data-pagi="false" data-arrows="false">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <div class="slide"><img src="{{ asset('assets/images/Alivepic17.jpg') }}" alt="Slider 1"></div>
                            <div class="slide"><img src="{{ asset('assets/images/Alivepic8.jpg') }}" alt="Slider 2"></div>
                            <div class="slide"><img src="{{ asset('assets/images/Alivepic19.jpg') }}" alt="Slider 3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="fslider" data-direction="horizontal" data-pagi="false" data-arrows="false">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <div class="slide"><img src="{{ asset('assets/images/Alivepic1.jpg') }}" alt="Slider 1"></div>
                            <div class="slide"><img src="{{ asset('assets/images/Alivepic2.jpg') }}" alt="Slider 2"></div>
                            <div class="slide"><img src="{{ asset('assets/images/Alivepic7.jpg') }}" alt="Slider 3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="fslider" data-direction="horizontal" data-pagi="false" data-arrows="false">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <div class="slide"><img src="{{ asset('assets/images/Alivepic11.jpg') }}" alt="Slider 1"></div>
                            <div class="slide"><img src="{{ asset('assets/images/Alivepic.jpg') }}" alt="Slider 2"></div>
                            <div class="slide"><img src="{{ asset('assets/images/Alivepic18.jpg') }}" alt="Slider 3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSS -->
<style>
    .button-success {
        background-color: #28a745;
        color: #fff;
    }

    #slider {
        position: relative; /* Parent container */
        z-index: 1; /* Keeps content above the default overlay */
    }

    #slider .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(227, 224, 224, 0.5); /* Semi-transparent background */
        z-index: 5; /* Below content */
    }

    .slider-inner {
        position: relative;
        z-index: 10; /* Content stays above the overlay */
    }

    .button {
        position: relative;
        z-index: 20; /* Buttons above everything else */
    }
</style>

@endsection
