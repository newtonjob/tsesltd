<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TSES - Technical Security Services, Construction and Supplies</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>
<body>
<div class="page-wrapper">

{{--    <div class="preloader"></div>--}}

    <header class="main-header header-style-two">

        <div class="header-top d-none d-xl-block">
            <div class="inner-container">
                <div class="top-left">

                    <ul class="list-style-one">
                        <li><i class="fa-solid fa-square fa-fw"></i> Technical Services and Equipment Solutions Limited</li>
                    </ul>
                </div>
                <div class="top-right">
                    <ul class="useful-links">
                        <li><a href="mailto:info@tsesltd.com"><i class="fas fa-envelope"></i>info@tsesltd.com</a></li>
                        <li>
                            <a href="javascript:">
                                <i class="fas fa-location-dot"></i>20 Baale Street. Igboefon  Lekki Epe Epress. Lekki Lagos Nigeria
                            </a>
                        </li>
                        <li><a href="tel:+2348099555550"><i class="fas fa-phone"></i>+2348099555550</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="header-lower">

            <div class="main-box">
                <div class="logo-box">
                    <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/img.png') }}" alt></a></div>
                </div>

                <div class="nav-outer">
                    <nav class="nav main-menu">
                        <ul class="navigation">
                            <li class="current"><a href="{{ route('home') }}">Home</a></li>

                            @if (false)
                                <li><a href="{{ route('shop.index') }}">Shop</a></li>

                                <li class="dropdown"><a href="javascript:">Services</a>
                                    <ul>
                                        <li><a href="page-services.html">Services List</a></li>
                                        <li><a href="page-service-details.html">Service Details</a></li>
                                    </ul>
                                </li>
                            @endif

                            {{--<li><a href="/projects">Projects</a></li>--}}
                            <li><a href="/about">About</a></li>
                            <li><a href="/#footer">Contact</a></li>
                        </ul>
                    </nav>

                    <div class="outer-box">
                        @if (false)
                            <div class="ui-btn-outer pe-0 me-0 border-0">
                                <button class="ui-btn ui-btn search-btn">
                                    <span class="icon lnr lnr-icon-search"></span>
                                </button>
                                <a href="shop-cart.html" class="ui-btn"><i class="lnr-icon-shopping-cart"></i></a>
                            </div>
                        @endif

                        <a href="#footer" class="theme-btn btn-style-one"><span class="btn-title">Get a solution</span></a>

                        <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="mobile-menu">
            <div class="menu-backdrop"></div>

            <nav class="menu-box">
                <div class="upper-box">
                    <div class="nav-logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt></a></div>
                    <div class="close-btn"><i class="icon fa fa-times"></i></div>
                </div>
                <ul class="navigation clearfix">

                </ul>
                <ul class="contact-list-one">
                    <li>

                        <div class="contact-info-box">
                            <i class="icon lnr-icon-phone-handset"></i>
                            <span class="title">Call Now</span>
                            <a href="tel:+92880098670">+92 (8800) - 98670</a>
                        </div>
                    </li>
                    <li>

                        <div class="contact-info-box">
                            <span class="icon lnr-icon-envelope1"></span>
                            <span class="title">Send Email</span>
                            <a href="mailto:"><span class="__cf_email__" data-cfemail="1179747d6151727e7c61707f683f727e7c">[email&#160;protected]</span></a>
                        </div>
                    </li>
                    <li>

                        <div class="contact-info-box">
                            <span class="icon lnr-icon-clock"></span>
                            <span class="title">Send Email</span>
                            Mon - Sat 8:00 - 6:30, Sunday - CLOSED
                        </div>
                    </li>
                </ul>
                <ul class="social-links" style="display: none">
                    <li><a href="javascript:"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="javascript:"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="javascript:"><i class="fab fa-pinterest"></i></a></li>
                    <li><a href="javascript:"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </nav>
        </div>

        <div class="search-popup">
            <span class="search-back-drop"></span>
            <button class="close-search"><span class="fa fa-times"></span></button>
            <div class="search-inner">
                <form method="post" action="https://html.kodesolution.com/2024/solen-html/{{ route('home') }}">
                    <div class="form-group">
                        <input type="search" name="search-field" value placeholder="Search..." required>
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>


        <div class="sticky-header">
            <div class="auto-container">
                <div class="inner-container">

                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('images/img.png') }}" alt></a>
                    </div>

                    <div class="nav-outer">

                        <nav class="main-menu">
                            <div class="navbar-collapse show collapse clearfix">
                                <ul class="navigation clearfix">

                                </ul>
                            </div>
                        </nav>

                        <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{ $slot }}

    <footer class="main-footer" id="footer">
        <div class="bg-image" style="background-image: url({{ asset('images/background/2.jpg') }})"></div>

        <div class="widgets-section">
            <div class="auto-container">
                <div class="row">

                    <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                        <div class="footer-widget about-widget">
                            <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/img.png') }}" alt></a></div>
                            <div class="text">Technical Services and Equipment Solutions Limited.</div>

                            <ul class="social-icon-two" style="display: none">
                                <li><a href="javascript:"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="javascript:"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="javascript:"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                        <div class="footer-widget">
                            <h3 class="widget-title">Explore</h3>
                            <ul class="user-links">
                                <li><a href="javascript:">Home</a></li>
                                <li><a href="#about">About</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                        <div class="footer-widget contact-widget">
                            <h3 class="widget-title">Contact</h3>
                            <div class="widget-content">
                                <div class="text">20 Baale Street. Igboefon  Lekki Epe Epress. Lekki Lagos Nigeria</div>
                                <ul class="contact-info">
                                    <li><i class="fa fa-envelope"></i> <a href="mailto:info@tsesltd.com">info@tsesltd.com</a><br></li>
                                    <li><i class="fa fa-phone-square"></i> <a href="tel:+926668880000">+234 8099 555 550</a><br></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="copyright-text">&copy; All rights reserved. <a href="{{ route('home') }}">{{ request()->host() }}</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>

<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>

@stack('scripts')

<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/appear.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/swiper.min.js') }}"></script>
<script src="{{ asset('js/owl.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
