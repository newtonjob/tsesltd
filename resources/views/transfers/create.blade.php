<x-app title="Transfer Products from {{ $location->name }}"  :links="['Admin', 'locations', $location->slug, 'transfers']">    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid" >
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card card-flush">
                        <div class="card-body p-15">
                            <form x-data x-submit action="{{ route('api.locations.transfers.store', $location) }}" id="bulk-transfers-form" method="POST" @finish="location.reload()">
                                <div class="form-group">
                                    <div class="mb-10 w-50">
                                        <label class="form-label" for="from-location">From</label>
                                        <input class="form-control" type="text" value="{{ $location->name }}" id="from-location" readonly>
                                    </div>
                                </div>
                                <div data-form-repeater>
                                <div class="form-group">
                                    <div data-repeater-list="product_transfer">
                                        <div data-repeater-item>
                                            <div class="row" x-data="{ max : 1 }">
                                                <div class="col-md-4 mb-5">
                                                    <label class="form-label required" for="product">Product</label>
                                                    <select class="form-select" name="product_id" id="product" required @change="max = $event.target.selectedOptions[0].dataset.max">
                                                        <option></option>
                                                        @foreach($location->products as $product)
                                                            @continue($product->stock->quantity <= 0)
                                                            <option value="{{ $product->id }}" data-max="{{ $product->stock->quantity }}">{{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-5">
                                                    <label class="form-label required" for="to-location">Location To</label>
                                                    <select class="form-select" name="to_location_id" id="to-location" required>
                                                        <option></option>
                                                        @foreach($locations as $to_location)
                                                            @continue($to_location->id == $location->id)
                                                            <option value="{{ $to_location->id }}">{{ $to_location->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2 mb-5">
                                                    <label class="form-label required" for="product-quantity">Quantity</label>
                                                    <input  id="product-quantity" class="form-control" type="number" name="quantity" value="1" min="1" :max="max" required>
                                                </div>
                                                <div class="col-md-2 mt-md-10 mb-10">
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
                                <div class="mt-10 mb-5 text-gray-500"><hr></div>
                                <div class="text-end p-3">
                                    <button type="submit" class="btn btn-primary">Transfer</button>
                                </div>
                        </form>
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
    @push('scripts')
        <script src="{{ asset('admin/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
        <script>
            $('[data-form-repeater]').repeater({
                initEmpty: false,
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
