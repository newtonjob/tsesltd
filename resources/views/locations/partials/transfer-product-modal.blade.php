<!--begin:: Transfer Product Modal-->
<div class="modal fade" id="transfer-product-modal" tabindex="-1" aria-labelledby="transfer-product-modal-label" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transfer-product-label">Transfer Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form x-submit action="{{ route('api.locations.transfers.store', $location) }}" method="POST"
                      @finish="location.reload()"
                      x-data="{ product : {} }"
                      @transfer.window="product = $event.detail.product"
                >
                    <div class="mb-10">
                        <label class="form-label">Product Name</label>
                        <input class="form-control" type="text" readonly x-model="product.name">
                        <input type="hidden" name="product_transfer[0][product_id]" x-model="product.id">
                    </div>
                    <div class="mb-10">
                        <div class="row">
                            <div class="col-md-6 mb-10">
                                <label class="form-label">Location From</label>
                                <input class="form-control" type="text" readonly value="{{ $location->name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">Location To</label>
                                <select class="form-select" name="product_transfer[0][to_location_id]" required>
                                    @foreach($locations as $to_location)
                                        @continue($to_location->id == $location->id)
                                        <option value="{{ $to_location->id }}">{{ $to_location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label class="form-label required">Quantity</label>
                            <input class="form-control" type="number" name="product_transfer[0][quantity]" value="1" min="1" :max="product.stock?.quantity">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Transfer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end:: Transfer Product Modal-->
