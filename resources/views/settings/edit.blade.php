<x-app title="Site Settings" :links="['Admin', 'Settings']">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <!--begin::Nav items-->
                <div class="rounded bg-gray-200 d-flex flex-stack flex-wrap mb-9 p-2">
                    <!--begin::Nav-->
                    <ul class="nav flex-wrap border-transparent">
                        <!--begin::Nav item-->
                        <li class="nav-item my-1">
                            <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1 active" data-bs-toggle="tab" href="#about-us">
                                About Us
                            </a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item my-1">
                            <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" data-bs-toggle="tab" href="#site-info">
                                Site Information
                            </a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item my-1">
                            <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" data-bs-toggle="tab" href="#business-info">
                                Business Settings
                            </a>
                        </li>
                        <!--end::Nav item-->
                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Nav items-->
                <div class="tab-content">
                    <!--begin::Basic info-->
                    <div id="about-us" class="tab-pane active">
                        <div class="card mb-5 mb-xl-10">
                            <!--begin::Card header-->
                            <div class="card-header border-0 cursor-pointer" role="button">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">Header</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--begin::Card header-->
                            <!--begin::Content-->
                            <div class="collapse show">
                                <form action="{{ route('api.settings.update') }}" method="POST" class="form" x-data x-submit>
                                    @method('put')
                                    <div class="card-body border-top p-9">
                                        <div class="row mb-2">
                                            <div class="col-lg-4 mb-0">
                                                <label for="header-title" class="fw-semibold fs-6 form-label">Title</label>
                                            </div>
                                            <div class="col-lg-8 mb-7">
                                                <textarea id="header-title" class="form-control" name="about[title]" rows="1" required>{{ site('about')->title }}</textarea>
                                            </div>
                                            <div class="col-lg-4 mb-0">
                                                <label for="header-body" class="fw-semibold fs-6 form-label">Body</label>
                                            </div>
                                            <div class="col-lg-8 mb-7">
                                                <textarea id="header-body" class="form-control" name="about[text1]" required>{{ site('about')->text1 }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top p-9">
                                        <h3 class="fw-bold m-0">Body</h3>
                                    </div>
                                    <div class="card-body border-top p-9">
                                        <div class="row mb-2">
                                            @foreach(site('about')->body as $key => $body)
                                                <div class="col-md-6 mb-7">
                                                    <div class="mb-7">
                                                        <label for="header-title" class="fw-semibold fs-6 form-label">Title</label>
                                                        <textarea id="header-title" class="form-control" name="about[body][{{ $key }}][title]" rows="1" required>{{ $body->title }}</textarea>
                                                    </div>
                                                    <div class="mb-5">
                                                        <label for="header-body" class="fw-semibold fs-6 form-label">Body</label>
                                                        <textarea id="header-body" class="form-control" name="about[body][{{ $key }}][body]" rows="10" required>{{ $body->body }}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <button type="submit" class="btn btn-primary">Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--end::Content-->
                        </div>
                    </div>
                    <!--end::Basic info-->
                    <!--begin::Basic info-->
                    <div id="site-info" class="tab-pane">
                        <div class="card mb-5 mb-xl-10">
                            <!--begin::Card header-->
                            <div class="card-header border-0 cursor-pointer" role="button">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">Site Info</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--begin::Card header-->
                            <!--begin::Content-->
                            <div class="collapse show">
                                <form action="{{ route('api.settings.update') }}" method="POST" class="form" x-data x-submit>
                                    @method('put')
                                    <div class="card-body border-top p-9">
                                        <div class="row mb-2">
                                            <div class="mb-7">
                                                <label for="site-title" class="fw-semibold fs-6 form-label">Site Title</label>
                                                <input id="site-title" class="form-control" name="title" value="{{ site('title') }}" required>
                                            </div>
                                            <div class="col-md-6 mb-7">
                                                <label for="site-desc" class="fw-semibold fs-6 form-label">Site Description</label>
                                                <textarea id="site-desc" class="form-control" name="description" rows="3" required>{{ site('description') }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-7">
                                                <label for="footer-quote" class="fw-semibold fs-6 form-label">Footer Quote</label>
                                                <textarea id="footer-quote" class="form-control" name="footer_quote" rows="3" required>{{ site('footer_quote') }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-7">
                                                <label for="site-phone" class="fw-semibold fs-6 form-label">Contact Phone Number(s)</label>
                                                <input id="site-phone" class="form-control" name="phone" value="{{ site('phone') }}" required>
                                            </div>
                                            <div class="col-md-6 mb-7">
                                                <label for="site-email" class="fw-semibold fs-6 form-label">Contact Email</label>
                                                <input id="site-email" type="email" class="form-control" name="email" value="{{ site('email') }}" required>
                                            </div>
                                            <div class="mb-7">
                                                <label for="shop-address" class="fw-semibold fs-6 form-label">Main Shop Address</label>
                                                <textarea id="shop-address" class="form-control" name="address" required>{{ site('address') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top p-9">
                                        <h3 class="fw-bold m-0">
                                            Social Media Links <small><i>(Use absolute URLs only)</i></small>
                                        </h3>
                                    </div>
                                    <div class="card-body border-top p-9">
                                        <div class="row mb-2">
                                            <div class="col-md-6 mb-7">
                                                <label for="facebook" class="fw-semibold fs-6 form-label">Facebook</label>
                                                <input id="facebook" class="form-control" name="social_links[facebook]" value="{{ site('social_links')->facebook }}" placeholder="e.g. https://facebook.com/example">
                                            </div>
                                            <div class="col-md-6 mb-7">
                                                <label for="instagram" class="fw-semibold fs-6 form-label">Instagram</label>
                                                <input id="instagram" class="form-control" name="social_links[instagram]" value="{{ site('social_links')->instagram }}" placeholder="e.g. https://instagram.com/example">
                                            </div>
                                            <div class="col-md-6 mb-7">
                                                <label for="twitter" class="fw-semibold fs-6 form-label">Twitter</label>
                                                <input id="twitter" class="form-control" name="social_links[twitter]" value="{{ site('social_links')->twitter }}" placeholder="e.g. https://twitter.com/example">
                                            </div>
                                            <div class="col-md-6 mb-7">
                                                <label for="linkedin" class="fw-semibold fs-6 form-label">Linkedin</label>
                                                <input id="linkedin" class="form-control" name="social_links[linkedin]" value="{{ site('social_links')->linkedin }}" placeholder="e.g. https://linkedin.com/example">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <!--end::Content-->
                        </div>
                    </div>
                    <!--end::Basic info-->
                    <!--begin::Basic info-->
                    <div id="business-info" class="tab-pane">
                        <div class="card mb-5 mb-xl-10">
                            <!--begin::Card header-->
                            <div class="card-header border-0 cursor-pointer" role="button">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">Exchange Rates</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--begin::Card header-->
                            <!--begin::Content-->
                            <div class="collapse show">
                                <form action="{{ route('api.settings.update') }}" method="POST" class="form" x-data x-submit>
                                    @method('PUT')
                                    <div class="card-body border-top p-9">
                                        <div class="row mb-2">
                                            <div class="col-lg-4 mb-0">
                                                <label for="exchange-rates-usd" class="fw-semibold fs-6 form-label">(USD to NGN)</label>
                                            </div>
                                            <div class="col-lg-8 mb-7">
                                                <input id="exchange-rates-usd" type="number" class="form-control" name="usd_exchange_rate" value="{{ site('usd_exchange_rate') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <button type="submit" class="btn btn-primary">Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--end::Content-->
                        </div>
                    </div>
                    <!--end::Basic info-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
</x-app>
