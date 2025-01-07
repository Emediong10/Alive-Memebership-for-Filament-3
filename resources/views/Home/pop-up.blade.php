{{-- @extends('layout.app')

@section('content') --}}
<div id="wrapper" class="clearfix">

    <!-- Content
    ============================================= -->
    <section id="content">
        <div class="content-wrap py-0">
            {{--
            <div class="d-flex align-items-center justify-content-center min-vh-100">
                <a href="#block-modal-request" data-lightbox="inline" class="button button-xlarge rounded-pill bg-primary nott ls0 px-6 py-3">New Request</a>
            </div> --}}

            <div class="modal-on-load" data-target="#block-modal-request"></div>

            <!-- Modal -->
            <div class="modal1 mfp-hide" id="block-modal-request">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-white p-4 p-md-5 rounded">
                        <div class="d-flex justify-content-between mb-2">
                            <h3 class="fw-semibold center"><strong>Different Membership Categories In
                                    ALIVE-Nigeria</strong> </h3>
                            <a href="" onClick="$.magnificPopup.close();return false;"
                                class="text-muted h4 mb-0 h-text-danger"><i class="icon-line-circle-cross"></i></a>
                        </div>
                        <div class="line double-line mt-2 mb-4"></div>

                        <div class="slider-title">


                            <h4 class="fw-semibold center"><strong>Financial Members</strong> </h4>

                          <bold> 1. Only those who desire by God's grace to support ALIVE NIGERIA with minimum of 10k and
                                above monthly. </bold> <br> <br>
                           <bold>2. Sponsors of ALIVE who make a huge donation once, twice or more yearly.</bold> <br> <br>
                           <bold>3. Donors of ALIVE on specific projects.
                            </bold> <br> <br>
                            <strong> Note:</strong>
                           <bold> All finical members are automatically members of all other forums. </bold> <br> <br>

                            <div class="line double-line mt-2 mb-4"></div>

                            <h4 class="fw-semibold center"> <strong>Outreach members</strong></h4>

                           <bold>1. All who wish to support ALIVE with a minimum of 2k to 9k monthly.</bold> <br> <br>
                           <bold>2. Engage in personal outreach weekly. </bold> <br> <br>
                           <bold>3. Willing to drop outreach reports with pictures. </bold> <br> <br>
                           <bold>4. Engage in intensive study periodically to be more equipped for services. </bold> <br> <br>
                            <strong>Note:</strong>
                           <bold>all outreach members automatically belong to the volunteer forum but cant be members of
                                the financial forum</bold> <br> <br>

                            <div class="line double-line mt-2 mb-4"></div>
                            <h4 class="fw-semibold center"> <strong>Volunteer members</strong> </h4>
                           <bold>1. Those who may not have any sources of income at the moment and can't support ALIVE
                                with a minimum of 2k monthly.
                            </bold> <br> <br>
                           <bold>2. Those wish to remain active members of ALIVE NIGERIA and her programs
                            </bold> <br> <br>
                           <bold>3. Those Who will support with with maximum of 1k monthly
                            </bold> <br> <br>
                            <strong>Note:</strong>
                           <bold>All volunteer members can only be members of general ALIVE-NIGERIA forum</bold> <br> <br>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section><!-- #content end -->


</div> {{-- @endsection --}}

