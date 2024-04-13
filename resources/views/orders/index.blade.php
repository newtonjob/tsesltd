<x-app title="Orders"  :links="['Admin', 'Orders']">
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
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <input type="text" id="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Order" aria-label="search">
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <a href="{{ route('shop.index') }}" class="btn btn-sm btn-primary">Shop</a>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed table-hover fs-6 gy-5" data-table data-search-using="#search">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th>Order ID</th>
                                        <th>Products</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Phone Number</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach($orders as $order)
                                        <tr class="cursor-pointer" onclick="location.href = @js(route('orders.show', $order))">
                                            <td data-order="{{ $order->id }}" class="min-w-50px">
                                                <a href="{{ route('orders.show', $order) }}" class="text-gray-800 text-hover-primary fw-bold"># {{ $order->id }}</a>
                                            </td>
                                            <td>
                                                <div class="symbol-group symbol-hover text-center flex-nowrap">
                                                    @foreach($order->products as $product)
                                                        @break($loop->iteration == 4 && $order->products->count() > 4)
                                                        <div class="symbol symbol-35px symbol-circle border" data-bs-toggle="tooltip" title="{{ $product->name }}">
                                                            <img alt="product image" class="border" src="{{ $product->image?->thumbnail }}" />
                                                        </div>
                                                    @endforeach
                                                    @if(($product_count = $order->products->count()) > 4)
                                                        <a href="{{ route('orders.show', $order) }}" class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                           title="{{ $order->products->skip(3)->implode('name', ', ') }}"
                                                        >
                                                            <span class="symbol-label bg-light text-gray-400 fs-8 fw-bold">
                                                                +{{ $product_count - 3 }}
                                                            </span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-circle symbol-35px overflow-hidden me-2">
                                                        <a href="{{ route('users.show', $order->user) }}">
                                                            <div class="symbol-label">
                                                                <img src="{{ $order->user->photo }}" alt="{{ $order->user->name }}" class="w-100" />
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="ms-2">
                                                        <a href="{{ route('users.show', $order->user) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $order->user->name }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pe-0">
                                                <!--begin::Badges-->
                                                <x-payment-status :$order />
                                                <br>
                                                <x-order-status :$order />
                                                <!--end::Badges-->
                                            </td>
                                            <td class="pe-0" data-order="{{ $order->total }}">
                                                <span class="fw-bold">₦{{ number_format($order->total) }}</span>
                                            </td>
                                            <td data-order="{{ $order->user->phone }}">
                                                <span class="fw-bold">{{ $order->user->phone }}</span>
                                            </td>
                                            <td class="min-w-50px" data-order="{{ $order->created_at }}">
                                                <span class="fw-bold">{{ $order->created_at->format('d M Y, h:i a') }}</span>
                                            </td>
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
</x-app>
