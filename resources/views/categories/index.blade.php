<x-app title="Categories" :links="['Admin', 'Categories']">
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
                                    <input type="text" id="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Category" aria-label="search"/>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"/>
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    Add Category
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" data-table data-search-using="#search">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th>Category</th>
                                        <th>Number Of Products</th>
                                        <th class="text-end"></th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('categories.edit', $category) }}" class="symbol symbol-50px">
                                                        <span class="symbol-label" style="background-image:url({{ $category->thumbnail }});"></span>
                                                    </a>
                                                    <div class="ms-5">
                                                        <a href="{{ route('categories.edit', $category) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $category->name }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $category->products_count }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('products.index', ['category' => $category]) }}" class="btn btn-sm btn-light btn-active-light-primary">Product List</a>
                                                    <button href="categories.html#" class="btn btn-sm btn-light btn-active-light-primary dropdown-toggle dropdown-toggle-split" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    </button>
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                                        @foreach($category->subCategories as $subCategory)
                                                            <div class="menu-item px-3">
                                                                <a href="{{ route('products.index').'?sub-category='.$subCategory->slug }}" class="menu-link px-3">
                                                                    {{ $subCategory->name }}
                                                                </a>
                                                            </div>
                                                        @endforeach
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
    <!--end:::Main-->
</x-app>
