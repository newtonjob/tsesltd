<x-site>
    <x-slot:og>
        <meta property="og:title" content="{{ $product->name }}" />
        <meta property="og:description" content="{{ str($product->description)->stripTags()->words(30) }}" />
        <meta property="og:image" content="{{ $product->image?->src }}" />
    </x-slot:og>

    <!-- Inner Page Breadcrumb -->
    <x-site.breadcrumbs title="Product Details"/>

    <!-- Shop Single Content -->
    <section class="shop-single-content pb80 pt0 ovh">
        <div class="container">
            <div class="row wrap">
                <div class="col-xl-7">
                    <div class="column">
                        <div class="shop_single_natabmenu">
                            <div class="d-block d-sm-flex align-items-start posr pb100-xs">
                                <div class="nav d-flex flex-sm-column nav-pills me-0 me-sm-3 custom_nav_list" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                                    @foreach($product->images as $image)
                                        <button class="nav-link me-3 me-sm-0 {{ $loop->iteration == 1 ? 'active' : ''}}" id="image-{{ $image->id }}-tab" data-bs-toggle="pill" data-bs-target="#image-{{ $image->id }}" type="button" role="tab" aria-controls="image-{{ $image->id }}" aria-selected="true"><img src="{{ $image->src }}" alt=""></button>
                                    @endforeach
                                </div>
                                <div class="tab-content ms-0 m-xl-auto custom_tab_contents" id="v-pills-tabContent">
                                    @foreach($product->images as $image)
                                        <div class="tab-pane fade {{ $loop->iteration == 1 ? 'show active' : ''}}" id="image-{{ $image->id }}" role="tabpanel" aria-labelledby="image-{{ $image->id }}-tab">
                                            <div class="shop_single_navmenu_content justify-content-center">
                                                <a class="product_popup popup-img" href="{{ $image->src }}"><span class="flaticon-full-screen z-index-3"></span></a>
                                                <div class="zoomimg_wrapper m-auto hizoom hi3">
                                                    <img class="zoom-img" id="zoom_03" src="{{ $image->src }}" width="500" alt="{{ $product->name }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <h4 class="title mb15 mt-4">{{ $product->name }}</h4>
                        <a href="{{ route('shop.index', ['brand' => $product->brand]) }}" class=sub_title>{{ $product->brand?->name }} &nbsp;</a>
                        <div class="shop_single_product_details ps-0 mt-4 d-block d-xl-none text-center">
                            <div class="sspd_price mb-2"> ₦{{ number_format($product->price) }}
                                @if($product->discount > 0)
                                    <small>
                                        <del>₦{{ number_format($product->initialPrice) }}</del>
                                    </small>
                                @endif
                            </div>
                            <div class="mb-0">
                                <form action="{{ route('api.products.cart.store', $product) }}"
                                      @finish="$dispatch('cart-updated')" x-data x-submit
                                >
                                    <ul class="cart_btn_widget shop_single3_style db-767 d-flex mb-0">
                                        <li class="me-3 mb-2">
                                            <div class="cart_btn home_page_sidebar">
                                                <div class="quantity-block home_page_sidebar" x-data="{ quantity: 1 }">
                                                    <button class="quantity-arrow-minus2 shop_single_page_sidebar"
                                                            @click="quantity > 1 && quantity--" type="button"
                                                    >
                                                        <img src="{{ asset('images/icons/minus.svg') }}" alt="">
                                                    </button>
                                                    <input class="quantity-num2 shop_single_page_sidebar" name="quantity" type="number"
                                                           x-model="quantity" aria-label="quantity" min="1"
                                                    >
                                                    <button class="quantity-arrow-plus2 shop_single_page_sidebar" @click="quantity++" type="button">
                                                        <span class="flaticon-close"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="me-0 me-sm-3 mb-3"><button class="btn btn-thm">Add to cart</button></li>
                                        <li class="me-0 me-sm-3 mb-3"><a href="#" class="btn btn-white bdr_thm bdrs60">Buy Now</a></li>
                                    </ul>
                                </form>
                                <ul class="shop_single_wishlist_area db-400 d-flex align-items-center mb-3">
                                    <li class="pe-2 ms-2 ms-sm-0"><a href="#"><span class="flaticon-heart me-2"></span>Add to Wishlist</a></li>
                                    <li class="pe-2 ms-2"><a href="#"><span class="flaticon-question me-2"></span>Ask a Question</a></li>
                                    <li class="ms-2"><a href="#"><span class="flaticon-share me-2"></span>Share</a></li>
                                </ul>
                            </div>
                            <hr>
                            <div class="vendor_iconbox style2 d-flex mb-1 mt-4">
                                <span class="icon fz30 heading-color"><span class="flaticon-truck"></span></span>
                                <div class="details ms-3 mt-0">
                                    <p class="heading-color">Free Shipping: To specific locations</p>
                                </div>
                            </div>
                            <div class="vendor_iconbox style2 d-flex mb-0">
                                <span class="icon fz30 heading-color"><span class="flaticon-return-box"></span></span>
                                <div class="details ms-3 mt-0">
                                    <p class="heading-color">Free 30-Day returns <a class="tdu" href="">See Details</a></p>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="shortcode_widget_accprdons shop_single_accordion px-0 mt-5">
                            <div class="faq_according text-start">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Product Description</button>
                                            </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse show ps-1" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-0">
                                        <div class="card-header" id="headingSeven">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link collapsed text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">Customer Reviews</button>
                                            </h2>
                                        </div>
                                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-10 col-xl-7">
                                                        <div class="review_average mb30">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0">
                                                                    <div class="title">4.9</div>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <div class="sspd_postdate">
                                                                        <div class="sspd_review">
                                                                            <ul class="mb0">
                                                                                <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="total_review">2 reviews</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="product_single_content mb30">
                                                            <div class="mbp_pagination_comments">
                                                                <h5 class="mb30">10 Review For This Product</h5>
                                                                <div class="mbp_first d-flex align-items-center mb20">
                                                                    <div class="flex-shrink-0"> <img src="{{ asset('images/blog/reviewer2.png') }}" class="mr-3" alt="reviewer2.png') }}"> </div>
                                                                    <div class="flex-grow-1 ms-4">
                                                                        <div class="d-block d-md-flex">
                                                                            <div class="sspd_postdate me-2 mb10-sm">
                                                                                <div class="sspd_review">
                                                                                    <ul class="mb0">
                                                                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="sub_title">A high performance Mac with a long lasting battery</h5>
                                                                        </div>
                                                                        <div class="review_post_meta">Reviewed by Ali Tufan - April 27, 2022</div>
                                                                    </div>
                                                                </div>
                                                                <div class="review_content_para mb30">
                                                                    <p class="mt15 mb30">This is an unusually large advance over previous models, especially in raw computing power, but also in fun things like screen and headphone support.</p>
                                                                    <p>This Amazon listing has two different processors, the M1 Pro (listed as 16-Core GPU "style") and the M1 Max (32-Core GPU).</p>
                                                                </div>
                                                                <div class="review_cansel_btns d-flex mb30">
                                                                    <a href="#" class="btn me-2"><i class="fas fa-thumbs-up"></i></a>
                                                                    <a href="#" class="btn"><i class="fas fa-thumbs-down"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="bsp_reveiw_wrt mb-0">
                                                            <form class="comments_form">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h4 class="title mb20">Add a Review</h4>
                                                                        <p class="heading-color">Your email address will not be published. Required fields are marked *</p>
                                                                        <h5 class="mb0">Your rating of this product</h5>
                                                                        <div class="sspd_postdate vendor_single">
                                                                            <div class="sspd_review">
                                                                                <ul class="mb0">
                                                                                    <li class="list-inline-item"><a href="#"><i class="fal fa-star"></i></a></li>
                                                                                    <li class="list-inline-item"><a href="#"><i class="fal fa-star"></i></a></li>
                                                                                    <li class="list-inline-item"><a href="#"><i class="fal fa-star"></i></a></li>
                                                                                    <li class="list-inline-item"><a href="#"><i class="fal fa-star"></i></a></li>
                                                                                    <li class="list-inline-item"><a href="#"><i class="fal fa-star"></i></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="heading-color mb10">Your review</label>
                                                                            <textarea class="form-control" rows="6"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="heading-color mb10">Name</label>
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="heading-color mb10">Email</label>
                                                                            <input type="email" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                                            <label class="form-check-label" for="defaultCheck1">Save my name, email, and website in this browser for the next time I comment.</label>
                                                                        </div>
                                                                        <br>
                                                                        <button type="submit" class="btn btn-thm">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 offset-xl-1 d-none d-xl-block z0">
                    <div class="column">
                        <div class="shop_single_product_details sidebar mb-3 mb-xl-0">
                            <h4 class="title mb15">{{ $product->name }}</h4>
                            <a  href="{{ route('shop.index', ['brand' => $product->brand]) }}" class=sub_title>{{ $product->brand?->name }} &nbsp;</a>
                            <hr>
                            <div class="sspd_price mb25 mt20">
                                <div class="sspd_price mt-4 mb25"> ₦{{ number_format($product->price) }}
                                    @if($product->discount > 0)
                                        <small>
                                            <del>₦{{ number_format($product->initialPrice) }}</del>
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <form id="addToCart" action="{{ route('api.products.cart.store', $product) }}"
                                  @finish="$dispatch('cart-updated')" x-data x-submit
                            >
                                <ul class="cart_btns ui_kit_button mb15 d-flex justify-content-between">
                                    <li>
                                        <div class="cart_btn home_page_sidebar">
                                            <div class="quantity-block home_page_sidebar" x-data="{ quantity: 1 }">
                                                <button class="quantity-arrow-minus2 shop_single_page_sidebar"
                                                        @click="quantity > 1 && quantity--" type="button"
                                                >
                                                    <img src="{{ asset('images/icons/minus.svg') }}" alt="">
                                                </button>
                                                <input class="quantity-num2 shop_single_page_sidebar" name="quantity" type="number"
                                                       x-model="quantity" aria-label="quantity" form="addToCart" min="1"
                                                >
                                                <button class="quantity-arrow-plus2 shop_single_page_sidebar" @click="quantity++" type="button">
                                                    <span class="flaticon-close"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <button class="btn btn-thm">Add to cart</button>
                                    </li>
                                </ul>
                            </form>
                            <div class="d-grid mb-3">
                                <a href="#" class="btn btn-white bdr_thm ss_cart_btn">Buy Now</a>
                            </div>
                            <ul class="shop_single_wishlist_area d-block d-sm-flex align-items-center justify-content-center">
                                <li class="pe-2 ms-2 ms-sm-0"><a href="#"><span class="flaticon-heart me-2"></span>Wishlist</a></li>
                                <li class="pe-2 ms-2"><a href="#"><span class="flaticon-question me-2"></span>Ask a Question</a></li>
                                <li class="ms-2"><a href="#"><span class="flaticon-share me-2"></span>Share</a></li>
                            </ul>
                            <hr>
                            <div class="vendor_iconbox style2 d-flex mb-1 mt-4">
                                <span class="icon fz30 heading-color"><span class="flaticon-truck"></span></span>
                                <div class="details ms-3 mt-0">
                                    <p class="heading-color">Free Shipping: To specific locations</p>
                                </div>
                            </div>
                            <div class="vendor_iconbox style2 d-flex mb-0">
                                <span class="icon fz30 heading-color"><span class="flaticon-return-box"></span></span>
                                <div class="details ms-3 mt-0">
                                    <p class="heading-color">Free 30-Day returns <a class="tdu" href="">See Details</a></p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h2 class="title">Related products</h2>
                    </div>
                    <div class="navi_pagi_top_right related_product_slider slider_dib_sm shop_item_6grid_slider owl-theme owl-carousel">
                        @foreach($product->subCategory->products as $product)
                            <div class="item">
                                <div class="shop_item small_style bdr1 px-2 px-sm-3 mx--1">
                                    <x-site.product :$product/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt50">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h2 class="title">You may also like</h2>
                    </div>
                    <div class="navi_pagi_top_right related_product_slider slider_dib_sm shop_item_6grid_slider owl-theme owl-carousel">
                        @foreach($recommendedProducts as $product)
                            <div class="item">
                                <div class="shop_item small_style bdr1 px-2 px-sm-3 mx--1">
                                    <x-site.product :$product/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-site>
