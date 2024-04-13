<!-- Payment Modal-->
<div class="modal fade" id="payment-modal" tabindex="-1" aria-labelledby="payment-modal-label" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="update-label">How much do you want to pay?
                </h3>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <form x-submit action="{{ route('api.orders.transactions.store', $order) }}" data-quietly
                      @finish="initializePaystack" x-data="{ mode: 'full' }"
                >
                    <div class="fv-row mb-10">
                        <div class="row g-9" data-kt-buttons="true" data-kt-buttons-target=".payment-option">
                            <div class="col-12 col-md-6">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-4 payment-option">
                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-center">
                                            <input class="form-check-input" type="radio" name="payment_amount" value="full" checked="checked" x-model="mode">
                                        </span>
                                    <span class="ms-5">
                                            <span class="fs-6 fw-bold text-gray-800 d-block">Full Payment</span>
                                        </span>
                                </label>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-4 payment-option">
                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start">
                                            <input class="form-check-input" type="radio" name="payment_amount" value="part" x-model="mode">
                                        </span>
                                    <span class="ms-5">
                                            <span class="fs-6 fw-bold text-gray-800 d-block">Other Amount</span>
                                        </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-10 fv-row other-amount">
                        <div class="input-group mb-2">
                            <span class="input-group-text text-muted">₦</span>
                            <input class="form-control" type="number" name="amount" aria-label="amount"
                                   :placeholder="mode === 'part' ? 'Enter Amount...' : '{{ number_format($order->amountPayable()) }}'"
                                   :required="mode === 'part'"
                                   :disabled="mode === 'full'"
                                   :value="mode === 'full'"
                            >
                        </div>
                    </div>

                    @admin
                        <div class="d-flex flex-equal gap-5 gap-xxl-9 px-0 mb-12 col-sm-7 mx-auto" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                            <label class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4 active" data-kt-button="true">
                                <input class="btn-check" type="radio" name="channel" checked value="paystack">
                                <i class="ki-duotone ki-credit-cart fs-2hx">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                </i>
                                <span class="fs-6 fw-bold d-block mt-2">Paystack</span>
                            </label>
                            <label class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4" data-kt-button="true">
                                <input class="btn-check" type="radio" name="channel" value="cash">
                                <i class="ki-duotone ki-dollar fs-2hx">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                    <i class="path3"></i>
                                </i>
                                <span class="fs-7 fw-bold d-block mt-2">Cash</span>
                            </label>
                            <label class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4" data-kt-button="true">
                                <input class="btn-check" type="radio" name="channel" value="transfer">
                                <i class="ki-duotone ki-send fs-2hx">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                </i>
                                <span class="fs-7 fw-bold d-block mt-2">Transfer</span>
                            </label>
                        </div>
                    @else
                        <input type="hidden" name="channel" value="paystack">
                    @endadmin

                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary">Make Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://js.paystack.co/v2/inline.js"></script>
    <script>
        function initializePaystack({ detail: { data } }) {
            if (data.transaction.channel !== 'paystack') {
                return location.reload();
            }

            (new PaystackPop).newTransaction({
                email: @js($order->user->email),
                amount: data.transaction.amount * 100,
                reference: data.transaction.reference,
                key: @js(config('services.paystack.public_key')),
                onSuccess: () => {
                    swal({
                        title: "Thank you!",
                        text: "Your payment was successful.",
                        icon: "success",
                        closeOnClickOutside: false,
                        closeOnEsc: false
                    }).then(() => location.reload());
                }
            });
        }
    </script>
@endpush
