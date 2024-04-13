<x-app title="Edit Product" :links="['Admin', 'Product', '#'.$product->id]">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid " >
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl">
                    <!--begin:::Tabs-->
                    <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-10">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#generalTab">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#stockTab">Stock</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#salesHistoryTab">Sales History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#advancedTab">Advanced</a>
                            </li>
                        </ul>
                        <!--end:::Tabs-->
                        @can('manage-shop')
                            <form x-submit action="{{ route('api.products.destroy', $product) }}" data-confirm>
                                @method('delete')
                                <button class="ms-2 btn btn-light-danger btn-sm mb-5">
                                    <i class="ki-duotone ki-abstract-11">
                                        <i class="path1"></i>
                                        <i class="path2"></i>
                                    </i>
                                    Delete Product
                                </button>
                            </form>
                        @endcan
                    </div>
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="generalTab">
                            <!--begin::Images-->
                            <div class="card card-flush py-4 mb-10">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Product Images</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="fv-row mb-2">
                                        <div class="dropzone" data-endpoint="{{ route('api.products.images.store', $product) }}">
                                            @foreach($product->images as $image)
                                                <div class="dz-preview" x-data="{ show: true }" x-show="show" x-transition>
                                                    <img src="{{ $image->medium }}" alt="product image" width="120" class="rounded">
                                                     <form action="{{ route('api.images.destroy', $image) }}"
                                                           x-submit data-confirm method="POST" @finish="show = false"
                                                     >
                                                         @method('DELETE')
                                                         <button class="dz-remove"></button>
                                                    </form>
                                                </div>
                                            @endforeach
                                            <div class="dz-message needsclick justify-content-center mt-5">
                                                <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-400">Upload up to 10 images</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Images-->
                            <!--begin::Form-->
                            <form x-submit class="form d-flex flex-column flex-xl-row" action="{{ route('api.products.update', $product) }}" method="POST">
                                @method('PUT')
                                <!--begin::Aside column-->
                                <div class="d-flex flex-column gap-7 gap-lg-10 min-w-xl-350px mw-xl-350px mb-7 me-lg-10">
                                    <!--begin::Thumbnail settings-->
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title"><h2>Details</h2></div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <label class="required form-label">Sub Category</label>
                                            <select class="form-select mb-2" name="sub_category_id" data-control="select2" data-placeholder="Select a sub category" id="sub-category" aria-label="sub categories" required>
                                                <option></option>
                                                @foreach($subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}"
                                                            data-category="{{ $subCategory->category->name }}"
                                                            @selected($subCategory->is($product->subCategory))
                                                    >
                                                        {{ $subCategory->name }}
                                                    </option>
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
                                                <select class="form-select" data-control="select2" data-placeholder="Select a brand" aria-label="brand">
                                                    <option></option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}" @selected($brand->is($product->brand))>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="fv-row">
                                                <div class="form-check form-check-custom form-check-solid mb-2">
                                                    <input type="hidden" value="" name="featured_at">
                                                    <input class="form-check-input" type="checkbox" value="{{ now() }}" id="featured" name="featured_at" {{ $product->featured_at ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="featured">Mark as featured</label>
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
                                            <input name="tags" class="form-control mb-2" value="{{ $product->tags }}" aria-label="tags">
                                            <div class="text-muted fs-7">Add relevant tags to the product.</div>
                                        </div>
                                    </div>

                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>QR Code</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 text-center">
                                            <img src="{{ qr(route('shop.show', $product)) }}" class="" />
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
                                                    <input type="text" name="name" id="name" class="form-control mb-2" placeholder="Product full name" value="{{ $product->name }}" required>
                                                    <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>
                                                </div>
                                                <div class="mb-10 fv-row">
                                                    <label class="form-label required" for="model_no">Model Number</label>
                                                    <input type="text" name="model_no" class="form-control mb-2" placeholder="Product Model Number" value="{{ $product->model_no }}" id="model_no">
                                                    <div class="text-muted fs-7">Enter the product model number</div>
                                                </div>
                                                <div>
                                                    <label class="form-label" for="description">Description</label>
                                                    <textarea name="description" id="description" >
                                                        {!! $product->description !!}
                                                    </textarea>
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
                                                                <input type="number" id="price" name="price" class="form-control" placeholder="Product price" value="{{ $product->price }}" required aria-label="price">
                                                            </div>
                                                            <div class="text-muted fs-7">Set the product price.</div>
                                                        </div>

                                                    </div>
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <div class="mb-10 fv-row">
                                                            <label class="required form-label" for="cost_price">Cost Price</label>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text">₦</span>
                                                                <input type="number" name="cost_price" id="cost_price" class="form-control" placeholder="Product cost price" value="{{ $product->cost_price }}" required aria-label="cost price">
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
                                                         x-data="{ discount: '{{ $product->discount }}' }"
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
                        <div class="tab-pane fade" id="stockTab">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush">
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                        <div class="card-title">
                                            <h2>Available Stock</h2>
                                        </div>
                                        <div class="card-toolbar">
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-inventory">
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"/>
                                                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/>
                                                    </svg>
                                                </span>
                                                Add Received Inventory
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5" data-table>
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                    <th>Location</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @foreach($product->locations as $location)
                                                    <tr>
                                                        <td>
                                                            <a href="" class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                                                {{ $location->name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $location->stock->quantity }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="add-inventory" tabindex="-1" aria-labelledby="add-inventory-label" aria-hidden="false">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="add-inventory-label">Add Received Inventory</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form x-submit action="{{ route('api.stock.store') }}" x-data @finish="location.reload()">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" data-table >
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                            <th>Location</th>
                                                            <th>Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach($locations as $location)
                                                            <tr>
                                                                <td>
                                                                    <label for="{{ $location->slug }}-quantity">{{ $location->name }}</label>
                                                                </td>
                                                                <td class="w-25">
                                                                    <input class="form-control w-50" type="number" value="0"
                                                                           id="{{ $location->slug }}-quantity"
                                                                           name="quantity[{{ $location->id }}]"
                                                                    >
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary">Create</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="salesHistoryTab">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Sales History</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5" data-table>
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                    <th>Order ID</th>
                                                    <th>Customer</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @foreach($product->orders as $order)
                                                    <tr>
                                                        <td data-kt-ecommerce-order-filter="order_id" data-order="{{ $order->id }}">
                                                            <a href="{{ route('orders.show', $order) }}" class="text-gray-800 text-hover-primary fw-bold"># {{ $order->id }}</a>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                    <a href="{{ route('users.show', $order->user) }}">
                                                                        <div class="symbol-label">
                                                                            <img src="{{ $order->user->photo }}" alt="{{ $order->user->name }}" class="w-100" />
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="ms-5">
                                                                    <a href="{{ route('users.show', $order->user) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $order->user->name }}</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-order="{{ $order->pivot->price }}">
                                                            ₦{{ number_format($order->pivot->price) }}
                                                        </td>
                                                        <td>{{ $order->pivot->quantity }}</td>
                                                        <td>{{ $order->location_name }}</td>
                                                        <td data-order="{{ $order->created_at }}">
                                                            <span class="fw-bold">{{ $order->created_at->format('d M Y, h:i a') }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="advancedTab">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Advanced</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab content-->
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

                document.querySelectorAll('.dropzone').forEach((element) => {
                    new Dropzone(element, {
                        url: element.dataset.endpoint,
                        paramName: "file",
                        maxFiles: 10,
                        maxFilesize: 10,
                        addRemoveLinks: true,
                        accept: function (file, done) {
                            if (file.name == "wow.jpg") {
                                done("Naha, you don't.");
                            } else {
                                done();
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app>
