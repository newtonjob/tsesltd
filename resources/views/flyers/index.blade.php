<x-app title="Flyers/Ads" :links="['Admin', 'Flyers']">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid" >
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="mb-7 text-muted fw-semibold">This page allows you to create flyers for products. Pick a template to get started.</div>
                    <div class="row g-5 g-xl-8">
                        <div class="col-md-4">
                            <div class="card card-body">
                                <img class="w-100" src="{{ asset('admin/media/flyer/flyer-template-1.jpg') }}">
                                <button data-bs-toggle="modal" data-bs-target="#template-modal" class="btn btn-success mt-5">Use Template</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-body">
                                <img class="w-100" src="{{ asset('admin/media/flyer/flyer-template-2.jpg') }}">
                                <button class="btn btn-success mt-5">Use Template</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-body">
                                <img class="w-100" src="{{ asset('admin/media/flyer/flyer-template-3.jpg') }}">
                                <button class="btn btn-success mt-5">Use Template</button>
                            </div>
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
    <!-- Template Modal-->
    <div class="modal fade" id="template-modal" tabindex="-1" aria-labelledby="template-modal-label" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="update-label">Select Product</h3>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-abstract-11 fs-1">
                            <i class="path1"></i><i class="path2"></i>
                        </i>
                    </div>
                </div>
                <div class="modal-body">
                    <form x-submit action="" data-quietly x-data>
                        <div class="mb-10">
                            <label class="form-label required" for="template">Template</label>
                            <input class="form-control" type="text" name="template" id="template" value="">
                        </div>
                        <div class="mb-10">
                            <label class="form-label required" for="product">Select Product</label>
                            <select name="product_id" class="form-select form-select-solid" id="product" data-hide-search="true" data-control="select2" data-placeholder="Select Product" required>
                                <option></option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" >{{ $product->name }} - {{ $product->model_no }} - ₦{{ number_format($product->price) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app>
