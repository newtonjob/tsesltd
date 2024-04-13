<x-app title="Locations" :links="['Admin', 'Locations']">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid" >
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
                                    <input type="text" id="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Locations" />
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-location-modal">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"/>
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    New Location</button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" data-table data-search-using="#search">
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-200px">Location</th>
                                        <th class="min-w-100px">Address</th>
                                        <th class="text-center">Stock Quantity</th>
                                        <th class="text-center">Stock Value (₦)</th>
                                        <th class="text-center">Stock Cost Value (₦)</th>
                                        <th class="text-center">Stock Profit Value (₦)</th>
                                        <th class="min-w-125px"></th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach($locations as $location)
                                        <tr>
                                            <td>
                                                <a href="{{ route('locations.show', $location) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-bs-toggle="modal" data-bs-target="#edit-location-{{ $location->id }}">
                                                    {{ $location->name }}
                                                    @if($location->isPublic())
                                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                                                            Public
                                                        </span>
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                {{ $location->address }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($location->products->sum('stock.quantity')) }}
                                            </td>
                                            <!--end::Type--->
                                            <!--begin::Type--->
                                            <td class="text-center">
                                                {{ number_format($location->products->sum('stock_value')) }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($location->products->sum('cost_value')) }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($location->products->sum('profit_value')) }}
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
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true" x-data="{ location : {{ $location }} }">
                                                    <div class="menu-item px-3" @click="$dispatch('editing', { location : location, action : @js(route('api.locations.update', $location)) })">
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#edit-location-modal">
                                                            Edit Location
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('locations.show', $location) }}" class="menu-link px-3">
                                                            Location Products
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <form action="{{ route('api.locations.destroy', $location) }}" method="POST"
                                                              x-data x-submit @finish="location.reload()"
                                                              data-confirm="Deleting this Location will also delete any available stock of the Location."
                                                        >
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-sm menu-link text-start px-3 text-danger">
                                                                Delete Location
                                                            </button>
                                                        </form>
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
    <!--begin:: Location create Modal-->
    <div class="modal fade" id="add-location-modal" tabindex="-1" aria-labelledby="add-location-modal-label" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-location-modal-label">Add New Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form x-data x-submit action="{{ route('api.locations.store') }}" id="add-location" method="POST" @finish="location.reload()">
                        <div class="mb-10">
                            <label class="form-label required" for="name">Location Name</label>
                            <input class="form-control" type="text" name="name" id="name" required>
                        </div>
                        <div class="mb-10">
                            <label class="form-label required" for="address">Location Address</label>
                            <textarea class="form-control" id="address" name="address" required></textarea>
                        </div>
                        <div class="form-check mb-10">
                            <input type="hidden" name="featured_at" value=""/>
                            <input id="featured" class="form-check-input" type="checkbox" name="featured_at" value="{{ now() }}"/>
                            <label for="featured" class="form-check-label fw-semibold text-gray-700 fs-base">
                                Make Available to <span class="text-primary">Public</span>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="add-location">Create</button>
                </div>
            </div>
        </div>
    </div>
    <!--end:: Location create Modal-->
    <!--begin:: Location edit Modal-->
    <div class="modal fade" id="edit-location-modal" tabindex="-1" aria-labelledby="edit-location-modal-label" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" x-data="{ location : {}, action : {} }" @editing.window="location = $event.detail.location; action = $event.detail.action">
                    <form x-submit :action="action" method="POST" @finish="location.reload()">
                        @method('put')
                        <div class="mb-10">
                            <label class="form-label required">Location Name</label>
                            <input class="form-control" type="text" name="name" x-model="location.name" required>
                        </div>
                        <div class="mb-10">
                            <label class="form-label required">Location Address</label>
                            <textarea class="form-control" name="address" required x-model="location.address"></textarea>
                        </div>
                        <div class="form-check mb-10">
                            <input type="hidden" name="featured_at" value=""/>
                            <input id="featured" class="form-check-input" type="checkbox" name="featured_at" value="{{ now() }}" :checked="location.featured_at"/>
                            <label for="featured" class="form-check-label fw-semibold text-gray-700 fs-base">
                                Available to <span class="text-primary">Public</span>
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end:: Location edit Modal-->
    @push('scripts')
        <script src="{{ asset('admin/js/custom/apps/ecommerce/catalog/categories.js') }}"></script>
    @endpush
</x-app>
