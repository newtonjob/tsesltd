<x-site>
    <x-site.breadcrumbs title="About Us"/>
    <!-- About Us & Team -->
    <section class="our-team pt0 pb40">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="aboutus_thumb">
                        <img class="img-fluid w100" src="{{ asset('images/resource/about1.jpg') }}" alt="About1 Image">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                        <div class="aboutus_thumb">
                            <img class="img-fluid w100" src="{{ asset('images/resource/about17.jpg') }}" alt="About2 Image">
                        </div>
                        <div class="aboutus_thumb">
                            <img class="img-fluid w100" src="{{ asset('images/resource/about10.jpg') }}" alt="About3 Image">
                        </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="aboutus_thumb">
                        <img class="img-fluid w100" src="{{ asset('images/resource/about30.jpg') }}" alt="About4 Image">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="aboutus_thumb">
                        <img class="img-fluid w100" src="{{ asset('images/resource/about2.jpg') }}" alt="About5 Image">
                    </div>
                    <div class="aboutus_thumb">
                        <img class="img-fluid w100" src="{{ asset('images/resource/about14.jpg') }}" alt="About6 Image">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-10 m-auto pt30">
                    <div class="main-title">
                        <h2>{{ site('about')->title }}</h2>
                    </div>
                    <div class="about_us_content mb30 mt15">
                        <h4 class="title">{{ site('about')->text1 }}</h4>
                    </div>
                    <div class="row mb45">
                        @foreach(site('about')->body as $body)
                            <div class="col-lg-6">
                                <div class="aboutus_mission_vision">
                                    <h4 class="title">{{ $body->title }}</h4>
                                    <p>{{ $body->body }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt30">
                <div class="col-xl-10 m-auto pt60 bdrt1">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="main-title">
                                <h2 class="mtitle">{{ site('footer_quote') }}</h2>
                            </div>
                            <a class="about_page_shop_btn btn btn-white" href="{{ route('shop.index') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt60">
                <div class="col-xl-10 m-auto pt60 bdrt1">
                    <div class="main-title">
                        <h2>Why You Should Choose Us</h2>
                    </div>
                </div>
                <div class="col-xl-10 m-auto">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="icon_boxes about_style text-center">
                                <div class="icon">
                                    <span class="flaticon-shield"></span>
                                </div>
                                <div class="details">
                                    <h4 class="title">Money Guarantee</h4>
                                    <p class="para">You have 30 days to return.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="icon_boxes about_style text-center">
                                <div class="icon">
                                    <span class="flaticon-headphones"></span>
                                </div>
                                <div class="details">
                                    <h4 class="title">Online Support</h4>
                                    <p class="para">Contact Us 24 hours everyday.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="icon_boxes about_style text-center">
                                <div class="icon">
                                    <span class="flaticon-credit-card"></span>
                                </div>
                                <div class="details">
                                    <h4 class="title">Flexible Payment</h4>
                                    <p class="para">We ensure Secure payments with multiple credit cards.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-home.partners />
</x-site>
