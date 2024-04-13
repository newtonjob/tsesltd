<x-app title="Transfers" :links="['Admin', 'Transfers']">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid" >
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5 border-0 cursor-pointer" role="button">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <input type="text" id="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Transfers" />
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div>
                                    <a href="#" class="btn btn-sm btn-light btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="top-end">
                                        Transfers products from ...
                                        <span class="svg-icon svg-icon-5 m-0">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-250px py-4" data-kt-menu="true">
                                        @foreach($locations as $location)
                                            <div class="menu-item px-3">
                                                <a href="{{ route('locations.transfers.create', $location) }}" class="menu-link px-3">{{ $location->name }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" data-table data-search-using="#search">
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th>Transfer Id</th>
                                        <th>Initiated by</th>
                                        <th>Transfer Products</th>
                                        <th>Transfer Date</th>
                                        <th></th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach($transfers as $transfer)
                                        <tr>
                                            <td>
                                                <a href="{{ route('transfers.show', $transfer) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                                    {{ sprintf("%04d",$transfer->id) }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <a href="{{ route('users.show', $transfer->creator) }}">
                                                            <div class="symbol-label">
                                                                <img src="{{ $transfer->creator->photo }}" alt="{{ $transfer->creator->name }}" class="w-100" />
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="ms-5">
                                                        <a href="{{ route('users.show', $transfer->creator) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                                            {{ $transfer->creator->name }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="symbol-group symbol-hover flex-nowrap">
                                                    @foreach($transfer->products->take(4) as $product)
                                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $product->slug }}">
                                                            <img alt="product image" src="{{ $product->image?->thumbnail }}" />
                                                        </div>
                                                    @endforeach
                                                    @if(($product_count = count($transfer->products)) > 4)
                                                        <a href="{{ route('transfers.show', $transfer) }}" class="symbol symbol-35px symbol-circle">
                                                            <span class="symbol-label bg-light text-gray-400 fs-8 fw-bold">
                                                                +{{ $product_count - 4 }}
                                                            </span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td data-order="{{ $transfer->created_at }}">
                                                <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                                    {{ $transfer->created_at->format('d M Y, h:i a') }}
                                                </a>
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
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('transfers.show', $transfer) }}" class="menu-link px-3">View Details</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('transfers.waybill.show', $transfer) }}" class="menu-link px-3">Get Waybill</a>
                                                    </div>
                                                </div>
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
    <!--end::Main-->
</x-app>
