<!--begin:: Stock shortage Modal-->
<div class="modal fade" id="stock-shortage-modal" tabindex="-1" aria-labelledby="stock-shortage-modal-label" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stock Shortage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning mb-15">
                    <small>
                        <b>Caution:</b>
                        Product quantity automatically reduces when order/sales are dispatched. Only use this feature to manually reduce product quantity for shortages due to damage or error in received inventory.
                    </small>
                </div>
                <form x-submit method="POST" @finish="location.reload()"
                      :action="action"
                      x-data="{ product : {}, action : null }"
                      @shortage.window="product = $event.detail.product; action = $event.detail.action"
                >
                    @method('delete')
                    <div class="mb-10">
                        <label class="form-label">Product Name</label>
                        <input class="form-control" type="text" readonly x-model="product.name">
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-md-6 mb-10">
                                <label class="form-label">Location From</label>
                                <input class="form-control" type="text" value="{{ $location->name }}" readonly>
                            </div>
                            <div class="col-md-6 mb-10">
                                <label class="form-label required">Quantity</label>
                                <input class="form-control" type="number" name="quantity" value="1" min="1" :max="product.stock?.quantity" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end:: Stock shortage Modal-->
