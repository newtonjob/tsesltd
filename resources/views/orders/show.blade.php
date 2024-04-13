<x-app title="Order {{ $order->id }}" :links="['Admin', 'Order', '#'.$order->id]">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-lg-n2 me-auto">
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                       href="#order_summary">Order Summary</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                       href="#payment" id="dispatchButton">Payment @admin & Dispatch @endadmin</a>
                                </li>
                            </ul>
                            @can('delete', $order)
                                <form x-submit action="{{ route('api.orders.destroy', $order) }}" data-confirm>
                                    @method('delete')

                                    <button class="ms-2 btn btn-light-danger btn-sm me-lg-n7">
                                        <i class="ki-duotone ki-abstract-11">
                                            <i class="path1"></i>
                                            <i class="path2"></i>
                                        </i>
                                        Cancel Order
                                    </button>
                                </form>
                            @endcan
                            @can('update', $order)
                                <a  class="btn btn-primary btn-sm me-lg-n7" x-data @click="dispatchButton.click()">
                                    <i class="ki-duotone ki-delivery fs-2">
                                        <i class="path1"></i>
                                        <i class="path2"></i>
                                        <i class="path3"></i>
                                        <i class="path4"></i>
                                        <i class="path5"></i>
                                    </i>
                                    Dispatch
                                </a>
                            @endcan
                            <button data-bs-toggle="modal" data-bs-target="#payment-modal" class="btn btn-success btn-sm">
                                <i class="ki-duotone ki-credit-cart fs-2"><i class="path1"></i><i class="path2"></i></i>
                                Make Payment
                            </button>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="order_summary">
                                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                    <div class="card card-flush py-4 flex-row-fluid">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Order Details (#{{ $order->id }})</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                    <tbody class="fw-semibold text-gray-600">
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="svg-icon svg-icon-2 me-2">
                                                                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="currentColor"/>
                                                                            <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="currentColor"/>
                                                                        </svg>
                                                                    </span>
                                                                    Date Added
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">{{ $order->created_at->format('d M Y, h:i a') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="svg-icon svg-icon-2 me-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="currentColor"/>
                                                                            <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="currentColor"/>
                                                                            <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="currentColor"/>
                                                                        </svg>
                                                                    </span>
                                                                    Payment Status
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">
                                                                <x-payment-status :$order/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="svg-icon svg-icon-2 me-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor"/>
                                                                            <path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor"/>
                                                                        </svg>
                                                                    </span>
                                                                    Delivery Method
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">
                                                                {{ strtoupper($order->delivery_type) }}
                                                                <x-order-status :$order/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="svg-icon svg-icon-2 me-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                             height="16" fill="currentColor"
                                                                             class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                                                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                                                                        </svg>
                                                                    </span>
                                                                    Delivery Address
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end" data-bs-toggle="tooltip" title="{{ $order->delivery_address }}">
                                                                {{ str($order->delivery_address)->limit(25) ?? 'None' }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-flush py-4  flex-row-fluid">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Customer Details</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                    <tbody class="fw-semibold text-gray-600">
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="svg-icon svg-icon-2 me-2">
                                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"/>
                                                                            <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"/>
                                                                            <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"/>
                                                                        </svg>
                                                                    </span>
                                                                    Customer
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">
                                                                <div class="d-flex align-items-center justify-content-end">
                                                                    <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                                        <a href="{{ route('users.show', $order->user) }}">
                                                                            <div class="symbol-label">
                                                                                <img src="{{ $order->user->photo }}"
                                                                                     alt="Dan Wilson" class="w-100"/>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <a href="{{ route('users.show', $order->user) }}" class="text-gray-600 text-hover-primary">
                                                                        {{ $order->user->name }}
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="svg-icon svg-icon-2 me-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"/>
                                                                            <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"/>
                                                                        </svg>
                                                                    </span>
                                                                    Email
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">
                                                                <a href="{{ route('users.show', $order->user) }}"
                                                                   class="text-gray-600 text-hover-primary">
                                                                    {{ $order->user->email }}
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="svg-icon svg-icon-2 me-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor"/>
                                                                            <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor"/>
                                                                        </svg>
                                                                    </span>
                                                                    Phone
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">{{ $order->user->phone }}</td>
                                                        </tr>
                                                        @if($order->creator && $order->user->isNot($order->creator))
                                                            <tr>
                                                                <td class="text-muted">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="svg-icon svg-icon-2 me-2">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                                                            </svg>
                                                                        </span>
                                                                        Sales Person
                                                                    </div>
                                                                </td>
                                                                <td class="fw-bold text-end">
                                                                    <a href="{{ route('users.show', $order->creator) }}"
                                                                       class="text-gray-600 text-hover-primary">
                                                                        {{ $order->creator->name }}
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-flush py-4  flex-row-fluid">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Documents</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                    <tbody class="fw-semibold text-gray-600">
                                                    <tr>
                                                        <td class="text-muted">
                                                            <div class="d-flex align-items-center">
                                                                <span class="svg-icon svg-icon-2 me-2">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor"/>
                                                                        <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor"/>
                                                                        <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                              fill="currentColor"/>
                                                                    </svg>
                                                                </span>
                                                                Invoice
                                                            </div>
                                                        </td>
                                                        <td class="fw-bold text-end">
                                                            <div class="btn-group">
                                                                <a href="{{ route('orders.invoice.show', $order) }}" target="_blank" class="btn btn-sm btn-light-linkedin">Get Invoice</a>
                                                                <button href="categories.html#" class="btn btn-sm btn-light-linkedin dropdown-toggle dropdown-toggle-split" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                                </button>
                                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-175px py-4" data-kt-menu="true">
                                                                    <div class="menu-item px-3">
                                                                        <a href="" class="menu-link px-3">Resend to Customer</a>
                                                                    </div>
                                                                    <div class="menu-item px-3">
                                                                        <a href="{{ route('orders.invoice.show', [$order, 'tses' => 'true']) }}" target="_blank" class="menu-link px-3">Get Invoice as TSES</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">
                                                            <div class="d-flex align-items-center">
                                                                <i class="ki-duotone ki-directbox-default me-2 fs-2">
                                                                    <i class="path1"></i>
                                                                    <i class="path2"></i>
                                                                    <i class="path3"></i>
                                                                    <i class="path4"></i>
                                                                </i>
                                                                Waybill
                                                            </div>
                                                        </td>
                                                        <td class="fw-bold text-end">
                                                            <div>
                                                                <button href="categories.html#" class="btn btn-sm btn-light-info dropdown-toggle dropdown-toggle-split" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Print Waybill &nbsp;
                                                                </button>
                                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-175px py-4" data-kt-menu="true">
                                                                    <div class="menu-item px-3">
                                                                        <a href="{{ route('orders.waybill.show', $order) }}" target="_blank" class="menu-link px-3">Bensu Waybill</a>
                                                                    </div>
                                                                    <div class="menu-item px-3">
                                                                        <a href="{{ route('orders.waybill.show', [$order, 'tses' => 'true']) }}" target="_blank" class="menu-link px-3">TSES Waybill</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-7 gap-lg-10 mt-10">
                                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Order #{{ $order->id }}</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                            <th class="min-w-175px">Product</th>
                                                            <th class="min-w-100px text-end">Model Number</th>
                                                            <th class="min-w-70px text-end">Qty</th>
                                                            <th class="min-w-100px text-end">Unit Price</th>
                                                            <th class="min-w-100px text-end">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach($order->products as $product)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <a href="{{ route('products.edit', $product) }}" class="symbol symbol-50px">
                                                                            <span class="symbol-label" style="background-image:url({{ $product->image?->thumbnail }});"></span>
                                                                        </a>
                                                                        <div class="ms-5">
                                                                            <a href="{{ route('products.edit', $product) }}"
                                                                               class="fw-bold text-gray-600 text-hover-primary">{{ $product->name }}</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-end">
                                                                    {{ $product->model_no }}
                                                                </td>
                                                                <td class="text-end">
                                                                    {{ $product->pivot->quantity }}
                                                                </td>
                                                                <td class="text-end">
                                                                    ₦{{ number_format($product->pivot->price) }}
                                                                </td>
                                                                <td class="text-end">
                                                                    ₦{{ number_format($product->pivot->amount) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="4" class="text-end">
                                                                Subtotal
                                                            </td>
                                                            <td class="text-end">
                                                                ₦{{ number_format($order->total) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" class="text-end">
                                                                Delivery
                                                            </td>
                                                            <td class="text-end">
                                                                ₦{{ number_format($order->delivery_fee, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" class="fs-3 fw-bolder text-dark text-end">
                                                                Total
                                                            </td>
                                                            <td class="text-dark fs-3 fw-bolder text-end">
                                                                ₦{{ number_format($order->total) }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payment">
                                @can('update', $order)
                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <div class="card card-flush py-4 flex-row-fluid">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Dispatch Information</h2>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="table-responsive"
                                                     x-data="{ dispatched: @js($order->isDispatched()) }"
                                                >
                                                    <form x-submit action="{{ route('api.orders.dispatch', $order) }}"
                                                          @finish="dispatched = true"
                                                    >
                                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                            <thead>
                                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                                <th class="min-w-100px">Product</th>
                                                                <th class="min-w-175px">Quantity</th>
                                                                <th class="min-w-70px">From Location</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="fw-semibold text-gray-600">
                                                            @foreach($order->products as $product)
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{ route('products.edit', $product) }}"
                                                                           class="fw-bold text-gray-600 text-hover-primary">{{ $product->name }}</a>
                                                                    </td>
                                                                    <td>{{ $product->pivot->quantity }}</td>
                                                                    <td class="mw-400px">
                                                                        @if($order->isDelivered())
                                                                            {{ $product->pivot->location?->name }}
                                                                        @else
                                                                            <select class="form-select" aria-label="location" required
                                                                                    name="products[{{ $product->id }}][location_id]"
                                                                            >
                                                                                <option>Select Location</option>
                                                                                @foreach($product->locations as $location)
                                                                                    <option value="{{ $location->id }}"
                                                                                        @selected($product->pivot->location?->is($location))
                                                                                    >
                                                                                        {{ $location->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="3" class="text-end">
                                                                    <button class="btn btn-light-primary" x-show="! dispatched">
                                                                        <i class="ki-duotone ki-delivery fs-2">
                                                                            <i class="path1"></i>
                                                                            <i class="path2"></i>
                                                                            <i class="path3"></i>
                                                                            <i class="path4"></i>
                                                                            <i class="path5"></i>
                                                                        </i>
                                                                        Dispatch
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                    @if($order->isNotDelivered())
                                                        <div class="text-end" x-show="dispatched">
                                                            <button class="ms-2 btn btn-light-danger" @click="dispatched = false">
                                                                <i class="ki-duotone ki-arrow-circle-left fs-2">
                                                                    <i class="path1"></i>
                                                                    <i class="path2"></i>
                                                                </i>
                                                                Change Dispatch
                                                            </button>
                                                            <form action="{{ route('api.orders.update', $order) }}" x-submit class="d-inline" @finish="location.reload()">
                                                                @method('PUT')
                                                                <input type="hidden" name="delivered_at" value="{{ now() }}">
                                                                <button class="ms-2 btn btn-light-success">
                                                                    <i class="ki-duotone ki-courier fs-2">
                                                                        <i class="path1"></i>
                                                                        <i class="path2"></i>
                                                                        <i class="path3"></i>
                                                                    </i>
                                                                    Mark As Delivered
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                                <div class="d-flex flex-column gap-7 gap-lg-10 mt-10">
                                    <div class="card card-flush py-4 flex-row-fluid">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Payment Information</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                            <th>Reference</th>
                                                            <th>Channel</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th>Initiated by</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach($order->paidTransactions as $transaction)
                                                            <tr>
                                                                <td>{{ $transaction->reference }}</td>
                                                                <td>{{ $transaction->channel }}</td>
                                                                <td>₦{{ number_format($transaction->amount) }}</td>
                                                                <td>
                                                                    <div @class(['badge', 'badge-light-success' => $transaction->paid_at, 'badge-light-warning' => ! $transaction->paid_at])>{{ $transaction->paid_at ? 'Successful' : 'Pending Payment' }}</div>
                                                                </td>
                                                                <td>{{ $transaction->paid_at->format('d M Y, h:i a') }}</td>
                                                                <td>
                                                                    <a href="{{ route('users.show', $transaction->creator) }}" class="text-gray-600 text-hover-primary">{{ $transaction->creator->name }}</a>
                                                                </td>
                                                                <td>
                                                                    @can('delete', $transaction)
                                                                        <form x-submit action="{{ route('api.transactions.destroy', $transaction) }}" data-confirm="Are you sure you want to cancel this transaction?" x-data @finish="location.reload()">
                                                                            @method('delete')
                                                                            <button class="btn btn-light-danger btn-sm">
                                                                                <i class="ki-duotone ki-abstract-11">
                                                                                    <i class="path1"></i>
                                                                                    <i class="path2"></i>
                                                                                </i>
                                                                                Cancel
                                                                            </button>
                                                                        </form>
                                                                    @endcan
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-transactions.modal-create :$order />

</x-app>
