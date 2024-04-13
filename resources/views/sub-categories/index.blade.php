<x-app title="Sub Categories" :links="['Admin', 'Sub Categories']">
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
                                    <input id="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Sub Category" aria-label="search">
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-sub-category-modal">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"/>
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    Add Sub Category
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" data-table>
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th>Sub Category</th>
                                        <th class="min-w-125px">Category</th>
                                        <th class="min-w-125px text-center">Number Of Products</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach($subCategories as $subCategory)
                                        <tr>
                                            <td>
                                                <a href="" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-sub-category-filter="sub_category_name">{{ $subCategory->name }}</a>
                                            </td>
                                            <td>{{ $subCategory->category->name }}</td>
                                            <td class="text-center">{{ $subCategory->products_count }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('products.index', ['sub-category' => $subCategory]) }}" class="btn btn-sm btn-light-primary">Product List</a>
                                                </div>
                                            </td>
                                            <td class="text-end">
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
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#edit-sub-category-{{ $subCategory->id }}">
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-ecommerce-category-filter="delete_row">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="edit-sub-category-{{ $subCategory->id }}" tabindex="-1" aria-labelledby="edit-sub-category-{{ $subCategory->id }}-label" aria-hidden="false">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-sub-category-{{ $subCategory->id }}-label">Edit Sub Category</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form x-data x-submit action="{{ route('api.sub-categories.update', $subCategory) }}" id="edit-sub-category-{{ $subCategory->id }}-form" method="POST" @finish="location.reload()">
                                                            @method('PUT')
                                                            <div class="mb-10">
                                                                <label class="form-label required" for="name-{{ $subCategory->id }}">Sub Category Name</label>
                                                                <input class="form-control" type="text" name="name" value="{{ $subCategory->name }}" required id="name-{{ $subCategory->id }}">
                                                            </div>
                                                            <div class="mb-10">
                                                                <label class="form-label required" for="category-{{ $subCategory->id }}">Category</label>
                                                                <select name="category_id" class="form-select" id="category-{{ $subCategory->id }}" required>
                                                                    <option></option>
                                                                    @foreach($categories as $category)
                                                                        <option @selected($category->is($subCategory->category))
                                                                                value="{{ $category->id }}"
                                                                        >
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" form="edit-sub-category-{{ $subCategory->id }}-form">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <div class="modal fade" id="add-sub-category-modal" tabindex="-1" aria-labelledby="add-sub-category-modal-label" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-sub-category-modal-label">Create Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form x-data x-submit action="{{ route('api.sub-categories.store') }}" id="add-sub-category" method="POST" @finish="location.reload()">
                        <div class="mb-10">
                            <label class="form-label required" for="name">Sub Category Name</label>
                            <input class="form-control" type="text" name="name" id="name" required>
                        </div>
                        <div class="mb-10">
                            <label class="form-label required" for="category">Category</label>
                            <select name="category_id" class="form-select form-select-solid" id="category" data-hide-search="true" data-control="select2" data-placeholder="Select a Category" required>
                                <option></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="add-sub-category">Create</button>
                </div>
            </div>
        </div>
    </div>
</x-app>
