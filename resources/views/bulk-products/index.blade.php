<x-app title="Products Bulk Update" :links="['Admin', 'Products', 'Bulk Update']">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid " >
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <input type="text" id="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Product" aria-label="search">
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary btn-sm ms-3" form="bulk-update-form">Save</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="alert alert-warning d-flex align-items-center p-5">
                                <i class="ki-duotone ki-information-3 fs-2x text-warning me-2"><i class="path1"></i><i class="path2"></i><i class="path3"></i></i>
                                <p class="mb-1 fw-bold text-warning">Save your changes before switching pages.</p>
                            </div>
                            <form action="{{ route('api.bulk-products.update') }}" x-data x-submit id="bulk-update-form">
                                @method('PUT')
                                <table class="table align-middle table-row-dashed fs-6 gy-5" data-table data-search-using="#search">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>Product</th>
                                            <th>Model Number</th>
                                            <th>Price Currency</th>
                                            <th>Cost Price</th>
                                            <th>Selling Price</th>
                                            <th>Discount(%)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach($products as $product)
                                            <tr>
                                                <td class="min-w-300px">
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('products.edit', $product) }}" class="symbol symbol-50px">
                                                            <span class="symbol-label" style="background-image:url({{ $product->image?->thumbnail }});"></span>
                                                        </a>
                                                        <div class="ms-5">
                                                            <a href="{{ route('products.edit', $product) }}" class="text-gray-800 text-hover-primary fw-bold">
                                                                {{ $product->name }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="min-w-80px">
                                                    <input class="form-control" name="products[{{ $product->id }}][model_no]" value="{{ $product->model_no }}"
                                                           aria-label="model number"
                                                    >
                                                </td>
                                                <td class="min-w-lg-100px">
                                                    <select class="form-select" name="products[{{ $product->id }}][currency]" data-control="select2" data-hide-search="true"
                                                            aria-label="currency"
                                                    >
                                                        <option value="ngn" @selected($product->currency == 'ngn')>NGN</option>
                                                        <option value="usd" @selected($product->currency == 'usd')>USD</option>
                                                    </select>
                                                </td>
                                                <td class="min-w-80px">
                                                    <input class="form-control" name="products[{{ $product->id }}][cost_price]"
                                                           value="{{ $product->cost_price }}" type="number" aria-label="cost price"
                                                    >
                                                </td>
                                                <td class="min-w-80px">
                                                    <input class="form-control" name="products[{{ $product->id }}][price]"
                                                           value="{{ $product->price }}" type="number" aria-label="price"
                                                    >
                                                </td>
                                                <td>
                                                    <input class="form-control" name="products[{{ $product->id }}][discount]" type="number"
                                                           value="{{ $product->discount }}" aria-label="discount" min="0" max="100"
                                                    >
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary btn-sm ms-3">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->
</x-app>
