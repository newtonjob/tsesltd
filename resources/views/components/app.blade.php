<!DOCTYPE html>
@props(['title' => '', 'links' => []])
<html lang="en">
<head><!--begin::Help drawer toggle-->
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width,initial-scale=1">
    <meta name="author" content="Newton Job - 07011227815">
    <title>{{ config('app.name') }}</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/logo/favicon.png') }}">
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="{{ asset('/img/logo/favicon.png') }}">
    <link rel="canonical" href="{{ route('home') }}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="{{ asset('admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>

    <livewire:styles />

    <script defer src="https://unpkg.com/alpinejs@3.13.0/dist/cdn.min.js"></script>

    @include('partials.google-analytics')
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
      data-kt-app-sidebar-enabled="true"
      data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
      data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
      class="app-default">
<!--begin::Theme mode setup on page load-->
<script>
    var defaultThemeMode = "light";
    var themeMode;

    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }

        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }

        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>
<!--end::Theme mode setup on page load-->

<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

        <x-app.topbar :$title :$links />

        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid pt-10" id="kt_app_wrapper">

            <x-app.sidebar/>

            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                <x-app.verification-alert/>

                {{ $slot }}

                <!--begin::Footer-->
                <div id="kt_app_footer" class="app-footer ">
                    <!--begin::Footer container-->
                    <div
                        class="app-container  container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3 ">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">{{ date('Y') }} &copy;</span>
                            <a href="{{ config('app.url') }}" target="_blank" class="text-gray-800 text-hover-primary">Bensu</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                            <li class="menu-item">
                                <a href="{{ route('about-us') }}" class="menu-link px-2">About Us</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('contact-us') }}" class="menu-link px-2">Support</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('shop.index') }}" class="menu-link px-2">Purchase</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Footer container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->

<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                      fill="currentColor"/>
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="currentColor"/>
            </svg>
        </span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->

<!--begin::Global Javascript-->
<script src="{{ asset('admin/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('admin/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $('[data-table]').each((index, table) => {
        datatable = $(table).DataTable({ 'order': [], 'pageLength': 25 });

        $($(table).data('search-using')).keyup(function (e) {
            datatable.search(e.target.value).draw();
        });
    });
</script>

<script>
    $('.menu-link[href="{{ url()->full() }}"]').addClass('active').closest('.menu-accordion').addClass('here show');
</script>

<livewire:scripts />

@stack('scripts')

<script src="https://unpkg.com/axios@1.4.0/dist/axios.min.js"></script>
<script src="{{ asset("js/request.js") }}"></script>
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
