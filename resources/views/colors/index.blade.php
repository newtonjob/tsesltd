<x-app title="Colors" :links="['Admin', 'Colors']">
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
                                    <input type="text" id="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Colors" />
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
                                    Add Color
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" data-table data-search-using="#search">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th>Color Name</th>
                                        <th class="text-center">Number of Products</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach($colors as $color)
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-bs-toggle="modal" data-bs-target="#edit-location-{{ $color->id }}">
                                                    {{ $color->name }}
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($color->products->count()) }}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('products.index', ['color' => $color]) }}" class="btn btn-sm btn-light-primary">Product List</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-bs-toggle="modal" data-bs-target="#edit-location-{{ $color->id }}">
                                                    <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg>
                                                </span>
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                        <!--begin:: Location edit Modal-->
                                        <div class="modal fade" id="edit-location-{{ $color->id }}" tabindex="-1" aria-labelledby="edit-location-{{ $color->id }}-label" aria-hidden="false">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-location-{{ $color->id }}-label">Edit Color</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form x-data x-submit action="{{ route('api.colors.update', $color) }}" id="edit-location-{{ $color->id }}-form" method="POST" @finish="location.reload()">
                                                            @method('PUT')
                                                            <div class="mb-10">
                                                                <label class="form-label required" for="name-{{ $color->slug }}">Color Name</label>
                                                                <input class="form-control" type="text" name="name" value="{{ $color->name }}" id="name-{{ $color->slug }}" placeholder="e.g White" required>
                                                            </div>
                                                        </form>
                                                        <form action="{{ route('api.colors.destroy', $color) }}" method="POST" x-data x-submit @finish="location.reload()">
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger rounded-0" onclick="return confirm('Are you sure you want to delete this color?')">
                                                                Delete Color
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" form="edit-location-{{ $color->id }}-form">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end:: Location edit Modal-->
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
    <!--SubCategory::create Modal-->
    <div class="modal fade" id="add-location-modal" tabindex="-1" aria-labelledby="add-location-modal-label" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-location-modal-label">Add New Color</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form x-data x-submit action="{{ route('api.colors.store') }}" id="add-location" method="POST" @finish="location.reload()">
                        <div class="mb-10">
                            <label class="form-label required" for="name">Color Name</label>
                            <input id="name" class="form-control" type="text" name="name" placeholder="e.g White" required>
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
</x-app>
