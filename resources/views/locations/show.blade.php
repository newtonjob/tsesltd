<x-app title="Products in {{ $location->name }}"  :links="['Admin', 'locations', $location->slug, 'products']">
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
                                    <input type="text" id="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Product" />
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('stock.create') }}" class="btn btn-sm btn-light-primary me-3">
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z" fill="currentColor"/>
                                                <path opacity="0.3" d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z" fill="currentColor"/>
                                                <path opacity="0.3" d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z" fill="currentColor"/>
                                                <path d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                        Received Inventory
                                    </a>
                                    <a href="{{ route('locations.transfers.create', $location) }}" class="btn btn-sm btn-primary">
                                        <span class="svg-icon svg-icon-2">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                                 <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                                             </svg>
                                        </span>
                                        Bulk Transfer
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" data-table data-search-using="#search">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-200px">Product</th>
                                        <th class="min-w-100px">Model Number</th>
                                        <th class="min-w-100px text-center">Quantity</th>
                                        <th class="min-w-100px text-center">Price</th>
                                        <th class="min-w-100px text-center">Discount</th>
                                        <th class="min-w-125px"></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach($location->products->where('stock.quantity', '!=', 0) as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('products.edit', $product) }}" class="symbol symbol-50px">
                                                        <span class="symbol-label" style="background-image:url({{ $product->image?->thumbnail }});"></span>
                                                    </a>
                                                    <div class="ms-5">
                                                        <a href="{{ route('products.edit', $product) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name">
                                                            {{ $product->name }}
                                                            @if($product->featured_at)
                                                                <div class="badge badge-light-success">Featured</div>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pe-0">
                                                <span class="fw-bold" data-bs-toggle="tooltip" title="{{ $product->model_no }}">
                                                    {{ str($product->model_no)->limit(10) }}
                                                </span>
                                            </td>
                                            <td class="pe-0 text-center" data-order="{{ $product->stock->quantity }}">
                                                    <span class="fw-bold ms-3">
                                                        {{ $product->stock->quantity }}
                                                    </span>
                                            </td>
                                            <td class="pe-0 text-center">
                                                ₦{{ number_format($product->price) }}
                                            </td>
                                            <td class="pe-0 text-center" data-order="{{ $product->discount }}">
                                                {{ $product->discount }}%
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Actions
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                </a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true" x-data="{ product : {{ $product }} }">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('products.edit', $product) }}" class="menu-link px-3">
                                                            Edit Product
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3" @click="$dispatch('transfer', { product : product })">
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#transfer-product-modal">
                                                            Transfer Product
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3"
                                                         @click="$dispatch('shortage', {
                                                            product : product,
                                                            action : @js(route('api.stock.destroy', $product->stock))
                                                         })"
                                                    >
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#stock-shortage-modal">
                                                            Stock Shortage
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    @include('locations.partials.stock-shortage-modal')
    @include('locations.partials.transfer-product-modal')
    @push('scripts')
        <script src="{{ asset('admin/js/custom/apps/ecommerce/catalog/products.js') }}"></script>
        <script src="{{ asset('admin/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
        <script>
            $('[data-form-repeater]').repeater({
                initEmpty: false,
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        </script>
    @endpush
</x-app>
