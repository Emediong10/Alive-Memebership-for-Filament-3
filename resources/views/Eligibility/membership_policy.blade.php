@props(['policies'])


@include('layouts.app')
{{-- @include('layouts.nav') --}}


<section id="page-title" class="page-title-parallax page-title-center page-title-dark include-header"
    style="background-image: linear-gradient(to top, rgba(254,150,3,0.5), #39384D), url('new/image/metal-ruler-2765212_1280.jpg'); background-size: cover; padding: 120px 0;"
    data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">
    <div id="particles-line"></div>

    <div class="container clearfix mt-4">
        <h1>ALIVE-NIGERIA STANDARDS </h1>
        <br>
        <p class="rounded-pill border border-light text-light">These are our standards for Christian living. Our position
            on several topics is outlined in the paragraphs below.
        </p>
    </div>
</section>

<section id="slider" class=""
    style="background: url('new/image/leaf-409258_1280.jpg') no-repeat center bottom / cover;">

    <div class="content-wrap" style="color: white;">
        <div class="container clearfix">
            <div class="slider-title">

                <div class="row col-mb-30, col-sm-3, center">


                    @foreach ($policies as $policy)
                    <div class="toggle toggle-bg" data-animate="fadeIn">
                        <div class="toggle-header rounded-top fw-normal flex-row-reverse">
                            <div class="toggle-icon">
                                <i class="icon-line-circle-plus"></i>
                            </div>
                            <div class="toggle-title fw-semibold ps-1">
                                <h1 class="font-bold"> {{ $policy->title }}</h1>
                            </div>
                        </div>
                        <div class="toggle-content rounded-bottom" style="color:white !important;">
                            <div class="color" >
                                {!! Str::markdown($policy->content) !!}
                            </div>
                        </div>

                    </div>
                @endforeach



                </div>
            </div>
        </div>

    </div>
    </div>
</section>

<style>
    .color p {
        color: white !important;
    }
    </style>
