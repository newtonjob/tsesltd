<section class="top-category pb30 pt20">
    <div class=container>
        <div class=row>
            <div class=col-lg-12>
                <div class="d-flex justify-content-between">
                    <div class=main-title>
                        <h2>Top Categories</h2>
                    </div>
                    <div class="main-title mb-5">
                        <a class="title_more_btn mt10" href="{{ url('shop') }}">View All Categories</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ovh">
            @foreach (app('categories')->take(8) as $category)
                <div class="col-6 col-md-3 col-xl wow fadeInUp" data-wow-duration={{ (0.3 * $loop->iteration).'s' }}>
                    <a href="{{ url("shop?category={$category->slug}") }}">
                        <div class=iconbox>
                            <div class=icon>
                                <img class="w-75 p-2" src="{{ $category->image }}" alt="{{ $category->name }} Image">
                            </div>
                            <div class=details>
                                <h5 class=title>{{ $category->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row ovh mt70">
            <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-duration=.8s>
                <div class="banner_one home1_style color3 mb30">
                    <div class=thumb>
                        <img class="float-end" height="240" width="248" src="{{asset('images/resource/laptop.png')}}" alt=smartwatch>
                    </div>
                    <div class=details>
                        <h3 class=title>Laptops</h3>
                        <a href="{{ url('shop?sub-category=laptop') }}" class=shop_btn>Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-duration=1s>
                <div class="banner_one home1_style color2 mb30">
                    <div class="thumb style1">
                        <img class="float-end" height="240" width="248" src="{{asset('images/resource/solar_panel.png')}}" alt=smartwatch>
                    </div>
                    <div class=details>
                        <h3 class=title>Solar Panels</h3>
                        <a href="{{ url('shop?sub-category=solar') }}" class=shop_btn>Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-duration=1.2s>
                <div class="banner_one home1_style color1 mb30">
                    <div class="thumb style1">
                        <img class="float-end" height="240" width="248" src="{{asset('images/resource/air_conditioner.png')}}" alt="air-conditioner">
                    </div>
                    <div class=details>
                        <h3 class=title>Air Conditioners</h3>
                        <a href="{{ url('shop?sub-category=air-conditioners') }}" class=shop_btn>Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
