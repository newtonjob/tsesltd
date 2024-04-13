<x-app title="Brands" :links="['Admin', 'Brands']">
    <!--begin::Image input placeholder-->
    <style>
        .image-input-placeholder {
            background-image: url('{{ asset('admin/media/svg/files/blank-image.svg') }}');
        }
        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url('{{ asset('admin/media/svg/files/blank-image-dark.svg') }}');
        }
    </style>
    <!--end::Image input placeholder-->
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
                                    <i class="ki-duotone ki-magnifier fs-2 position-absolute ms-4">
                                        <i class="path1"></i><i class="path2"></i>
                                    </i>
                                    <input type="text" id="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Brand" aria-label="search">
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-brand">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"/>
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    Add Brand
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" data-table data-search-using="#search">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th>Brand</th>
                                        <th>Number Of Products</th>
                                        <th class="text-end"></th>
                                        <th class="text-end"></th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach($brands as $brand)
                                        <tr x-data="{brand : {{ $brand }}, show : true }"
                                            x-show="show" x-transition
                                            @hide{{ $brand->id }}.window="show = false"
                                            @update{{ $brand->id }}.window="brand = $event.detail.brand;"
                                            @click="$dispatch('editing', {
                                                      brand: brand ?? @js($brand),
                                                      action: @js(route('api.brands.update', $brand))
                                                  })"
                                        >
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-link symbol symbol-50px" data-bs-toggle="modal"
                                                            data-bs-target="#edit-brand"
                                                    >
                                                        <span class="symbol-label" style="background-image:url({{ $brand->image }});"></span>
                                                    </button>
                                                    <div class="ms-5">
                                                        <button class="btn-link btn text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                data-bs-toggle="modal" data-bs-target="#edit-brand"
                                                        >
                                                            {{ $brand->name }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $brand->products_count }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('products.index', ['brand' => $brand]) }}" class="btn btn-sm btn-light-primary">Product List</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-end my-3 ">
                                                    <span data-bs-toggle="tooltip" title="Edit">
                                                        <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                                                data-bs-toggle="modal" data-bs-target="#edit-brand"
                                                        >
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                    </span>
                                                    <span data-bs-toggle="tooltip" title="Delete">
                                                        <button class="btn btn-icon btn-active-light-danger w-30px h-30px me-3"
                                                                @click="$dispatch('deleting', {
                                                                    id: @js($brand->id),
                                                                    action: @js(route('api.brands.destroy', $brand))
                                                                })"
                                                        >
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </span>
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
    <!--end:::Main-->
    <!--Brand::create Modal-->
    <div class="modal fade" id="add-brand" tabindex="-1" aria-labelledby="add-brand-label" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-brand-label">Add Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form x-data x-submit action="{{ route('api.brands.store') }}" method="POST" @finish="location.reload()" enctype="multipart/form-data">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title m-auto">
                                    <h5>Brand Image</h5>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change category image">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                                            <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>
                                <div class="mt-15 text-start">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Brand Name" aria-label="brand name" required>
                                    <div class="text-muted fs-7 mt-2">A brand name is required and recommended to be unique.</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Brand::edit Modal-->
    <div class="modal fade" id="edit-brand" tabindex="-1" aria-labelledby="edit-brand-label" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-brand-label">
                        Edit Brand
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  x-submit @finish="location.reload()" enctype="multipart/form-data"
                           :action="action" x-data="{ brand: {}, action: null }"
                           @editing.window="{ brand, action } = $event.detail"
                           @finish="$dispatch(`update${brand.id}`, { brand: brand })"
                    >
                        @method('PUT')
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title m-auto">
                                    <h5>Brand Image</h5>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px" :style="`background-image: url(${brand.image})`"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change category image">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                        {{--<input type="hidden" name="delete_image"/>--}}
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>
                                <div class="mt-15 text-start">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Brand Name" required x-model="brand.name" aria-label="brand name">
                                    <div class="text-muted fs-7 mt-2">A brand name is required and recommended to be unique.</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Delete Brand Form-->
    <form x-submit data-confirm="|Delete Brand?"
          :action="action"
          x-data="{ action: null, id : null }"
          @deleting.window="action = $event.detail.action; id = $event.detail.id; $dispatch('submit')"
          @finish="$dispatch(`hide${id}`)"
    >
        @method('delete')
    </form>
    <!-- End Delete Brand Form-->
</x-app>
