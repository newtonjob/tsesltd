<div class="header_middle pt20 pb20 dn-992 dark_blue">
    <div class=container>
        <div class=row>
            <div class="col-lg-2 col-xxl-2">
                <div class=header_top_logo_home1>
                    <div class="logo">
                        <a class=logo  style=font-size:32px href="{{ route('home') }}">BENSU<span class=text-thm>.</span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xxl-6">
                <div class=header_middle_advnc_search>
                    <div class=search_form_wrapper>
                        <div class=row>
                            <div class="col-auto pr0">
                                <div class=actegory>
                                    <select class=selectpicker id=selectbox_alCategory name="category" form="search">
                                        <option value="">All Category</option>
                                        @foreach(app('categories') as $category)
                                            <option value="{{ $category->slug }}" @selected(request('category') == $category->slug)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <x-site.search-bar id="search"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xxl-4 pr0-lg">
                <div class="hm_log_fav_cart_widget justify-content-center">
                    <div class=wrapper>
                        <ul class=mb0>
                            @auth()
                                <li class=list-inline-item>
                                    <a class="header_top_iconbox" href="{{ route('dashboard') }}">
                                        <div class="d-block d-md-flex">
                                            <div class=icon><span class=flaticon-profile></span></div>
                                            <div class=details>
                                                <p class=subtitle>{{ user()->first_name  }}</p>
                                                <h5 class=title>{{ user()->last_name  }}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @else
                                <li class=list-inline-item>
                                    <a class="header_top_iconbox signin-filter-btn" href="#">
                                        <div class="d-block d-md-flex">
                                            <div class=icon><span class=flaticon-profile></span></div>
                                            <div class=details>
                                                <p class=subtitle>Sign In</p>
                                                <h5 class=title>Account</h5>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endauth
{{--                            <li class=list-inline-item>--}}
{{--                                <a class=header_top_iconbox href="#">--}}
{{--                                    <div class="d-block d-md-flex">--}}
{{--                                        <div class=icon><span class=flaticon-heart></span><span class=badge>{{ 0 }}</span></div>--}}
{{--                                        <div class=details>--}}
{{--                                            <p class=subtitle>Wishlist</p>--}}
{{--                                            <h5 class=title>My Items</h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li class=list-inline-item>
                                <a class="header_top_iconbox cart-filter-btn" href="#">
                                    <div class="d-block d-md-flex">
                                        <div class=icon>
                                            <span>
                                                <img src="{{ asset('images/icons/flaticon-shopping-cart-white.svg') }}" alt="">
                                            </span>
                                            <span class="badge">
                                                <livewire:cart-count />
                                            </span>
                                        </div>
                                        <div class=details>
                                            <p class=subtitle>
                                                <livewire:cart-price />
                                            </p>
                                            <h5 class=title>Total</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<header class="header-nav menu_style_home_one main-menu light_blue">
    <nav class=posr>
        <div class="container posr menu_bdrt1">
            <div class=menu-toggle>
                <button type=button id=menu-btn>
                    <span class=icon-bar></span>
                    <span class=icon-bar></span>
                    <span class=icon-bar></span>
                </button>
            </div>
            <div class="posr logo1 home1_style">
                <div id=mega-menu>
                    <a class=btn-mega href="#">
                        <img class=me-2 src="{{ asset('images/desktop-nav-menu-white.svg') }}" alt="Desktop Menu Icon">
                        <span class="fw500 fz16 color-white vam">Browse Categories</span>
                    </a>
                    <ul class=menu>
                        @foreach(app('categories') as $category)
                            <li>
                                <a class=dropdown href="{{ route('shop.index', ['category'=> $category]) }}">
                                    <span class=menu-title>{{ $category->name }}</span>
                                </a>
                                <div class=drop-menu>
                                    <div class=one-third>
                                        <div class=cat-title>{{ $category->name }}</div>
                                        <ul class=mb20>
                                            @foreach($category->subCategories as $subCategory)
                                                <li>
                                                    <a href="{{ route('shop.index', ['sub-category'=> $subCategory]) }}">
                                                        {{ $subCategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <ul id=respMenu class="ace-responsive-menu menu_list_custom_code wa pl200" data-menu-style=horizontal>
                <li class=visible_list>
                    <a href="{{ route('home') }}" class="y-menu"><span class=title>Home</span></a>
                </li>
                <li class=visible_list>
                    <a href="{{ route('shop.index') }}" class="y-menu"><span class=title>Shop</span></a>
                </li>
                <li class=visible_list> <a href="#"><span class=title>Brands</span></a>
                    <ul>
                        @foreach (app('brands') as $brand)
                            <li><a href="{{ route('shop.index', ['brand' => $brand]) }}">{{ $brand->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                 <li class=visible_list>
                    <a href="{{ route('stores') }}" class="y-menu"><span class=title>Our Stores</span></a>
                </li>
                <li class=visible_list>
                    <a href="{{ route('about-us') }}" class="y-menu"><span class=title>About us</span></a>
                </li>
                <li class=visible_list>
                    <a href="{{ route('contact-us') }}" class="y-menu"><span class=title>Contact Us</span></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class=hiddenbar-body-ovelay></div>
<div class=signin-hidden-sbar>
    <div class=hsidebar-header>
        <div class=sidebar-close-icon><span class=flaticon-close></span></div>
        <h4 class=title>Sign-In</h4>
    </div>
    <div class=hsidebar-content>
        <div class="log_reg_form sidebar_area">
            <div class=login_form>
                <form id="signin-form" action="{{ route('api.login') }}" method="POST" x-data x-submit @finish="location.reload()">
                    <div class="mb-2 mr-sm-2">
                        <label for="email" class=form-label>Email</label>
                        <input id="email" name="email" type="email" class=form-control placeholder="Enter email address..." required>
                    </div>
                    <!--begin::Input group-->
                    <div class="fv-row mb-4" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <label for="password" class=form-label>Password</label>
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input id="password" name="password" type="password" class="form-control" placeholder="Enter Password..."/>
                                <span class="position-absolute translate-middle top-50 end-0" onclick="togglePasswordVisibility()">
                                    <i class="bi bi-eye-slash fs-5"></i>
                                    <i class="bi bi-eye fs-5 d-none"></i>
                                </span>
                            </div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Input group--->
                    <div class="custom-control custom-checkbox">
                        <input type=checkbox name="remember" class=custom-control-input id=remember>
                        <label class=custom-control-label for=remember>Remember me</label>
                        <a class="btn-fpswd float-end" href="#">Forgot Password?</a>
                    </div>
                    <button type=submit class="btn btn-log btn-thm mt20">Sign In</button>
                    <p class="text-center mb25 mt10">
                        Do not have an account yet? <a href="{{ route('register') }}">Create account</a>
                    </p>
                    <div class=hr_content>
                        <hr>
                        <span class=hr_top_text>or</span>
                    </div>
                    <ul class="login_with_social text-center mt30 mb0">
                        <li class="list-inline-item"><a href="javascript:void(0)"><i class="fab fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="{{ route('oauth.create', 'google') }}"><i class="fab fa-google"></i></a></li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>

<livewire:cart-modal />

<div id=page class=stylehome1>
    <div class=mobile-menu>
        <div class="header stylehome1  dark_blue">
            <div class=menu_and_widgets>
                <div class="mobile_menu_bar float-start">
                    <a class=menubar href="#menu"><span></span></a>
                    <a class=mobile_logo href="{{ route('home') }}">BENSU<span class=text-thm>.</span></a>
                </div>
                <div class=mobile_menu_widget_icons>
                    <ul class="cart mt15">
                        @auth()
                            <li class=list-inline-item>
                                <a class="cart_btn" href="{{ route('dashboard') }}">
                                    <span class="icon flaticon-profile"></span>
                                </a>
                            </li>
                        @else
                            <li class=list-inline-item>
                                <a class="cart_btn signin-filter-btn" href="#">
                                    <span class="icon flaticon-profile"></span>
                                </a>
                            </li>
                        @endauth
{{--                        <li class=list-inline-item>--}}
{{--                            <a class="cart_btn" href="#">--}}
{{--                                <span class="icon flaticon-heart"></span><span class="badge bgc-thm">{{ 0 }}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class=list-inline-item>
                            <a class="cart_btn cart-filter-btn" href="#">
                                <span class=icon>
                                    <img src="{{ asset('images/icons/flaticon-shopping-cart-white.svg') }}" alt="">
                                </span>
                                <span class="badge bgc-thm">
                                    <livewire:cart-count />
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class=mobile_menu_search_widget>
                <div class=header_middle_advnc_search>
                    <div class="container search_form_wrapper">
                        <div class=row>
                            <div>
                                <x-site.search-bar id="mobile_search"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=posr>
                <div class=mobile_menu_close_btn><span class=flaticon-close></span></div>
            </div>
        </div>
    </div>
    <nav id=menu class=stylehome1>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('shop.index') }}">Shop</a></li>
            <li><span>Brands</span>
                <ul>
                    @foreach (app('brands') as $brand)
                        <li><a href="{{ route('shop.index', ['brand' => $brand]) }}">{{ $brand->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('stores') }}">Our Stores</a></li>
            <li><a href="{{ route('about-us') }}">About us</a></li>
            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
            <li class="title my-3 bb1 pl20 fz20 fw500 pb-3">CATEGORIES</li>
            @foreach(app('categories') as $category)
                <li><span>{{ $category->name }}</span>
                    <ul>
                        @foreach($category->subCategories as $subCategory)
                            <li><a href="{{ route('shop.index', ['sub-category'=> $subCategory]) }}">
                                    {{ $subCategory->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </nav>
</div>

@push('scripts')
    <script>
        const togglePasswordVisibility = () => {
            const passwordInput = $('#password');
            passwordInput.attr('type', (i, val) => (val === 'password' ? 'text' : 'password'));
            $('.bi-eye, .bi-eye-slash').toggleClass('d-none');
            passwordInput.focus();
        };
    </script>
@endpush
