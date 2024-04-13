<x-app title="Add Product" :links="['Admin', 'Product', 'Create']">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid " >
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl">
                    <form x-submit class="form d-flex flex-column flex-xl-row" action="{{ route('api.products.store') }}" method="POST">
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 min-w-xl-350px mw-xl-350px mb-7 me-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title"><h2>Details</h2></div>
                                </div>
                                <div class="card-body pt-0">
                                    <label class="required form-label">Sub Category</label>
                                    <select class="form-select mb-2" name="sub_category_id" data-control="select2" data-placeholder="Select a sub category" id="sub-category" aria-label="sub categories" required>
                                        <option></option>
                                        @foreach($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}" data-category="{{ $subCategory->category->name }}">{{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7 mb-7">Add product to a sub category.</div>
                                    <!--end::Description-->
                                    <div>
                                        <label class="form-label" for="category">Category</label>
                                        <input class="form-control mb-10 bg-light" id="category" readonly>
                                    </div>
                                    <div class="mb-10">
                                        <label class="form-label">Brand</label>
                                        <select class="form-select" data-control="select2" data-placeholder="Select a brand" aria-label="brand" name="brand_id">
                                            <option></option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row">
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input type="hidden" value="" name="featured_at">
                                            <input class="form-check-input" type="checkbox" value="{{ now() }}" id="featured" name="featured_at">
                                            <label class="form-check-label fw-semibold" for="featured">Mark as featured</label>
                                        </div>
                                        <div class="text-muted fs-7">Allow product to be displayed in the featured section of the site</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Product Tags</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <input name="tags" class="form-control mb-2" aria-label="tags">
                                    <div class="text-muted fs-7">Add relevant tags to the product.</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Aside column-->
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>General</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="mb-10 fv-row">
                                            <label class="required form-label" for="name">Product Name</label>
                                            <input type="text" name="name" id="name" class="form-control mb-2" placeholder="Product full name" required>
                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <label class="required form-label" for="model_no">Model Number</label>
                                            <input type="text" name="model_no" class="form-control mb-2" placeholder="Product Model Number" id="model_no">
                                            <div class="text-muted fs-7">Enter the product model number</div>
                                        </div>
                                        <div>
                                            <label class="form-label" for="description">Description</label>
                                            <textarea name="description" id="description" ></textarea>
                                            <div class="text-muted fs-7 mt-2">Set a description to the product for better visibility.</div>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Pricing-->
                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Pricing</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="d-flex flex-wrap gap-5">
                                            <div class="fv-row w-100 flex-md-root">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label" for="price">Selling Price</label>
                                                    <div class="input-group mb-2">
                                                        <span class="input-group-text">₦</span>
                                                        <input type="number" id="price" name="price" class="form-control" placeholder="Product price" required aria-label="price">
                                                    </div>
                                                    <div class="text-muted fs-7">Set the product price.</div>
                                                </div>
                                            </div>
                                            <div class="fv-row w-100 flex-md-root">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label" for="cost_price">Cost Price</label>
                                                    <div class="input-group mb-2">
                                                        <span class="input-group-text">₦</span>
                                                        <input type="number" name="cost_price" id="cost_price" class="form-control" placeholder="Product cost price" aria-label="cost price" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="fs-6 fw-semibold mb-2">
                                                Discount Type
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select a discount type that will be applied to this product"></i>
                                            </label>
                                            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                                <div class="col">
                                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                            <input class="form-check-input" type="radio" name="discount_option" value="1" checked="checked" />
                                                        </span>
                                                        <span class="ms-5">
                                                            <span class="fs-4 fw-bold text-gray-800 d-block">No Discount</span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary  d-flex text-start p-6" data-kt-button="true">
                                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                            <input class="form-check-input" type="radio" name="discount_option" value="2" />
                                                        </span>
                                                        <span class="ms-5">
                                                            <span class="fs-4 fw-bold text-gray-800 d-block">Percentage %</span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                            <input class="form-check-input" type="radio" name="discount_option" value="3" />
                                                        </span>
                                                        <span class="ms-5">
                                                            <span class="fs-4 fw-bold text-gray-800 d-block">Fixed Price</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-none mb-10 fv-row" id="discount-percentage">
                                            <!--begin::Slider-->
                                            <div class="d-flex flex-column text-center mb-5"
                                                 x-data="{ discount: 0 }"
                                            >
                                                <div class="d-flex align-items-start justify-content-center mb-7">
                                                    <span class="fw-bold fs-3x" x-html="discount"></span>
                                                    <span class="fw-bold fs-4 mt-1 ms-2">%</span>
                                                </div>
                                                <div class="mb-10">
                                                    <input type="range" class="form-range" name="discount"
                                                           aria-label="discount" x-model="discount"
                                                    >
                                                </div>
                                            </div>
                                            <!--end::Slider-->
                                            <div class="text-muted fs-7">Set a percentage discount to be applied on this product.</div>
                                        </div>
                                        <div class="d-none mb-10 fv-row w-xl-75" id="fixed-discount">
                                            <label class="form-label" for="discounted_price">Fixed Discounted Price</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">₦</span>
                                                <input type="number" name="discounted_price" id="discounted_price" class="form-control" placeholder="Discounted price" aria-label="discounted price">
                                            </div>
                                            <div class="text-muted fs-7">Set the discounted product price. The product will be reduced at the determined fixed price</div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Pricing-->
                            </div>
                            <div class="d-flex justify-content-end mt-10">
                                <a href="{{ route('products.index') }}" class="btn btn-light me-5">Cancel</a>
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                        <!--end::Main column-->
                    </form>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->

    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script>
            $(function () {
                $('#sub-category').change(function () {
                    $('#category').val($('#sub-category option:selected').data('category'));
                }).change();

                $('#description').summernote({height: 200, dialogsInBody: true})
                $('.note-editor button[data-toggle="dropdown"]').attr('data-bs-toggle', 'dropdown')
                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.note-editor').length) {
                        $('.note-editor button[data-bs-toggle="dropdown"]').next('.dropdown-menu').removeClass('show');
                    }
                });

                $('input[name="discount_option"]').on('change', function() {
                    var value = $(this).val();
                    $('#discount-percentage').toggleClass('d-none', value !== '2');
                    $('#fixed-discount').toggleClass('d-none', value !== '3');
                });

                var input = document.querySelector('input[name="tags"]');
                var tagify = new Tagify(input, {
                    whitelist: ["new", "trending", "sale", "discounted", "selling fast", "last 10"],
                    dropdown: { maxItems: 20, classname: "tagify__inline__suggestions", enabled: 0 }
                });
                // Submit Input values as a comma-separated string
                input.closest('form').addEventListener('submit', () => {
                    input.value = tagify.value.map(tagData => tagData.value).join(', ');
                    tagify.loadOriginalValues();
                });
            });
        </script>
    @endpush
</x-app>
