<x-app title="Received Inventory" :links="['Admin', 'Stock', 'Received Inventory']">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid " >
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <p>
                                    <small>
                                        Here, you can add quantity to an inventory received. Simply select the appropriate product item and enter the quantity to add to each location. If the product item doesn't exist, please <a href="{{ route('products.create') }}">create a new item</a>.
                                    </small>
                                </p>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('api.stock.store') }}" x-data x-submit @finish="location.reload()" method="POST">
                                <div class="form-group w-50 mb-5">
                                    <h4 class="text-gray-600"><label for="product">Select Product</label></h4>
                                    <select class="form-select" data-control="select2" data-placeholder="Choose a Product" name="product_id" id="product" required>
                                        <option></option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }} - ₦{{ $product->price }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="">Location</th>
                                        <th class="">Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                    @foreach($locations as $location)
                                        <tr>
                                            <td><label for="{{ $location->slug }}-quantity">{{ $location->name }}</label></td>
                                            <td class="">
                                                <input class="form-control w-50" type="number" id="{{ $location->slug }}-quantity" name="quantity[{{ $location->id }}]" value="0">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="card-footer py-6 px-9 me-10">
                                    <div class="row">
                                        <div class="col-9"></div>
                                        <div class=" col-3">
                                            <button type="submit" class="btn btn-primary">Add Stock</button>
                                        </div>
                                    </div>
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
    <!--end:::Main-->
</x-app>
