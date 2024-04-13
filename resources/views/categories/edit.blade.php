<x-app title="Edit Category" :links="['Admin', 'Categories', $category->slug]">
    <style>
        .image-input-placeholder {
            background-image: url('{{ asset('admin/media/svg/files/blank-image.svg') }}');
        }
        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url('{{ asset('admin/media/svg/files/blank-image-dark.svg') }}');
        }
    </style>
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid " >
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <form x-data x-submit class="form d-flex flex-column flex-lg-row" action="{{ route('api.categories.update', $category) }}" method="POST" enctype="multipart/form-data" @finish="location.reload()">
                        @method('PUT')
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Image</h2>
                                    </div>
                                </div>
                                <div class="card-body text-center pt-0">
                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                        <div class="image-input-wrapper w-150px h-150px" style="background-image: url({{ $category->image }})"></div>
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
                                    <div class="text-muted fs-7">Set the category image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Relevance</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="fv-row">
                                        <div class="mb-2" x-data="{ relevance: '{{ $category->relevance }}' }">
                                            <div class="d-flex align-items-start justify-content-center mb-7">
                                                <span class="fw-bold fs-2x" x-html="relevance"></span>
                                            </div>
                                            <input type="range" name="relevance" class="form-range mb-2" x-model="relevance" aria-label="relevance">
                                        </div>
                                        <div class="text-muted fs-7">Set the category relevance for better visibility in the site</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>General</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Name</label>
                                        <input type="text" name="name" class="form-control mb-2" placeholder="Category Name" required value="{{ $category->name }}" aria-label="category name">
                                        <div class="text-muted fs-7">A category name is required and recommended to be unique.</div>
                                    </div>
                                    <div class="fv-row">
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input type="hidden" value="" name="featured_at" >
                                            <input class="form-check-input" type="checkbox" value="{{ now() }}"
                                                   id="featured" name="featured_at" @checked($category->featured_at) >
                                            <label class="form-check-label form-label" for="featured">Mark as featured</label>
                                        </div>
                                        <div class="text-muted fs-7">Allow category to be displayed in the featured section of the site</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Sub Categories</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div>
                                        @foreach($category->subCategories as $subCategory)
                                            <div  x-data="{subCategory : {{ $subCategory }}, show : true }"
                                                  x-show="show" x-transition
                                                  @hide{{ $subCategory->id }}.window="show = false"
                                                  @click="$dispatch('editing', {
                                                      subCategory: subCategory,
                                                      action: @js(route('api.sub-categories.update', $subCategory))
                                                  })"
                                            >
                                                <div class="form-group">
                                                    <div class="d-flex flex-column gap-3">
                                                        <div class="form-group d-flex flex-wrap align-items-center gap-5 mb-7">
                                                            <div class="w-lg-50 w-75" data-bs-toggle="modal" data-bs-target="#edit-sub-category">
                                                                <input class="form-control text-gray-700" aria-label="sub category"
                                                                       x-model="subCategory.name" disabled
                                                                >
                                                            </div>
                                                            <button class="btn btn-sm btn-icon btn-light-danger" type="button"
                                                                    @click="$dispatch('deleting', {
                                                                        id: @js($subCategory->id),
                                                                        action: @js(route('api.sub-categories.destroy', $subCategory))
                                                                    })"
                                                            >
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor"/>
                                                                        <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"/>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div data-form-repeater>
                                            <div class="form-group">
                                                <div data-repeater-list="sub_categories" class="d-flex flex-column gap-3">
                                                    <div data-repeater-item class="form-group d-flex flex-wrap align-items-center gap-5">
                                                        <input type="text" class="form-control mw-100 w-lg-50 w-75" name="name" placeholder="Sub Category Name" aria-label="sub category name" required>
                                                        <button type="button" data-repeater-delete class="btn btn-sm btn-icon btn-light-danger">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor"/>
                                                                    <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"/>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-5">
                                                <button type="button" data-repeater-create class="btn btn-sm btn-light-primary">
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"/>
                                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/>
                                                        </svg>
                                                    </span>
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->
    <!-- Start Edit Sub Category Modal-->
    <div class="modal fade" id="edit-sub-category" tabindex="-1" aria-labelledby="update-label" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-label">Update Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form x-submit
                          :action="action"
                          x-data="{ subCategory: {}, action: null }"
                          @editing.window="subCategory = $event.detail.subCategory; action = $event.detail.action"
                    >
                        @method('PUT')
                        <div>
                            <div>
                                <div class="form-group">
                                    <div class="d-flex flex-column gap-3">
                                        <div class="form-group d-flex flex-wrap align-items-center gap-5 mb-7">
                                            <div class="w-75">
                                                <label class="form-label required">Sub Category Name</label>
                                                <input class="form-control" aria-label="sub category" name="name"
                                                       x-model="subCategory.name" required
                                                >
                                            </div>
                                            <div>
                                                <br>
                                                <button type="button" class="btn btn-sm btn-icon btn-light-danger">
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor"/>
                                                            <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"/>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-7">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Sub Category Modal-->
    <!-- Start Delete Sub Category Form-->
    <form x-submit data-confirm="|Delete SubCategory?"
          :action="action"
          x-data="{ action: null, id : null }"
          @deleting.window="action = $event.detail.action; id = $event.detail.id; $dispatch('submit')"
          @finish="$dispatch(`hide${id}`)"
    >
        @method('DELETE')
    </form>
    <!-- End Delete Sub Category Form-->

    @push('scripts')
        <script src="{{ asset('admin/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
        <script>
            $('[data-form-repeater]').repeater({
                initEmpty: true,
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
