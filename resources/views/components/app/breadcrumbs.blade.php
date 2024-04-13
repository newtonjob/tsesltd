<!--begin::Page title-->
<div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
     data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_header_wrapper'}"
     class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ $title }}</h1>
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb fw-semibold fs-7 my-0 pt-1">
        @foreach($links as $link)
            <li class="breadcrumb-item text-muted">
                <a href="#" class="text-muted text-hover-primary">{{ $link }}</a>
            </li>
        @endforeach
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->
