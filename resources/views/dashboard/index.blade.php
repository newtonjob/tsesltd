<x-app title="Dashboard" :links="['Home', 'Dashboard']">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                @admin
                    <div class="row g-5 g-xl-10">
                        <div class="col-12 mb-5 mb-xl-10">
                            <div class="card card-flush h-xl-100">
                                <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-image:url({{ asset('admin/media/svg/shapes/top-green.png') }}" data-bs-theme="light">
                                    <h3 class="card-title align-items-start flex-column text-white pt-15">
                                        <span class="fw-bold fs-2x mb-3">{{ Illuminate\Support\Carbon::greet() }}, {{ user('first_name') }}! 👋</span>
                                        {{--<div class="fs-4 text-white">
                                            <span class="opacity-75">You have 4 tasks to complete</span>
                                        </div>--}}
                                    </h3>
                                </div>
                                <div class="card-body mt-n20">
                                    <div class="mt-n20 position-relative">
                                        <div class="row g-3 g-lg-6">
                                            <div class="col-6 col-lg-3">
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <div class="symbol symbol-30px me-5 mb-3">
                                                        <span class="symbol-label">
                                                            <span class="symbol-label">
                                                                <i class="ki-duotone text-primary ki-user fs-2x">
                                                                    <i class="path1"></i><i class="path2"></i>
                                                                </i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="m-0">
                                                        <span class="text-gray-700 fw-bolder d-block fs-2qx mb-1">{{ number_format($customers_count) }}</span>
                                                        <span class="text-gray-500 fw-semibold fs-6">Customers</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-3">
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <div class="symbol symbol-30px me-5 mb-3">
                                                        <span class="symbol-label">
                                                            <span class="symbol-label">
                                                                <i class="ki-duotone ki-lots-shopping text-primary fs-2qx">
                                                                    <i class="path1"></i><i class="path2"></i><i class="path3"></i>
                                                                    <i class="path4"></i><i class="path5"></i><i class="path6"></i>
                                                                    <i class="path7"></i><i class="path8"></i>
                                                                </i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="m-0">
                                                        <span class="text-gray-700 fw-bolder d-block fs-2qx mb-1">{{ number_format($products_count) }}</span>
                                                        <span class="text-gray-500 fw-semibold fs-6">Products</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-3">
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <div class="symbol symbol-30px me-5 mb-3">
                                                        <span class="symbol-label">
                                                            <span class="symbol-label">
                                                                <i class="ki-duotone ki-basket-ok text-primary fs-2x">
                                                                    <i class="path1"></i><i class="path2"></i>
                                                                    <i class="path3"></i><i class="path4"></i>
                                                                </i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="m-0">
                                                        <span class="text-gray-700 fw-bolder d-block fs-2qx mb-1">{{ number_format($orders_count) }}</span>
                                                        <span class="text-gray-500 fw-semibold fs-6">Orders</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-3">
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <div class="symbol symbol-30px me-5 mb-3">
                                                        <span class="symbol-label">
                                                            <span class="symbol-label">
                                                                <i class="ki-duotone ki-courier text-primary fs-2hx">
                                                                    <i class="path1"></i><i class="path2"></i><i class="path3"></i>
                                                                </i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="m-0">
                                                        <span class="text-gray-700 fw-bolder d-block fs-2qx mb-1">{{ number_format($awaiting_delivery) }}</span>
                                                        <span class="text-gray-500 fw-semibold fs-6">Awaiting Delivery</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endadmin

                <x-quote />
                
                <div class="row g-5 g-xl-10">
                    <div class="col-12 mb-5 mb-xl-10">
                        <div class="card card-flush">
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <div class="card-title">
                                    <h4>Latest Orders</h4>
                                </div>
                                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                    <a href="{{ route('shop.index') }}" class="btn btn-sm btn-primary">Shop</a>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" data-table data-search-using="#search">
                                    <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Phone Number</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td data-order="{{ $order->id }}" class="min-w-50px">
                                                <a href="{{ route('orders.show', $order) }}" class="text-gray-800 text-hover-primary fw-bold"># {{ $order->id }}</a>
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
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
</x-app>
