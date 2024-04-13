<div class="row">
    <!--begin::Content-->
    <div class="col-md-8">
        <div class="card card-flush card-p-0 bg-transparent border-0 ">
            <div class="card-body">
                <div class="card card-flush mb-5">
                    <div class="card-header align-items-center py-5">
                        <div class="card-title ms-5">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"/>
                                    </svg>
                                </span>
                                <input type="text" id="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Products" aria-label="search" wire:model="search">
                            </div>
                        </div>
                        <div class="card-toolbar me-5">
                            <div class="ms-5 position-relative my-1" wire:ignore>
                                <select class="form-select form-select-solid w-250px ps-14" aria-label="Category" wire:model="subCategory">
                                    <option value="">Select Category</option>
                                    @foreach($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-5">
                            <div class="card card-flush p-6 pb-5 h-md-100">
                                <div class="card-body text-center">
                                    <img src="{{ $product->image?->thumbnail }}" class="rounded-3 mb-4 img-fluid" alt="{{ $product->name }} image"/>
                                    <div class="mb-2">
                                        <div class="text-center">
                                            <a href="{{ route('products.edit', $product) }}" class="fw-bold text-gray-800 text-hover-primary" data-bs-toggle="tooltip" title="{{ $product->name }}">
                                                {{ str($product->name)->limit(45) }}
                                            </a>
                                            <span class="text-gray-400 fw-semibold d-block">{{ $product->subCategory?->name }}</span>
                                        </div>
                                    </div>
                                    <span class="text-success text-end fw-bold fs-5">
                                        ₦{{ number_format($product->price) }}
                                    </span>
                                    <div class="mt-3">
                                        <form action="{{ route('api.products.cart.store', $product) }}" method="post"
                                              x-submit wire:finish="$refresh" data-quietly
                                        >
                                            <button class="btn btn-sm btn-light-info"
                                                @disabled(cart()->contains($product))
                                            >
                                                Add to cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($products->isEmpty())
                        <div class="col-12 mb-5">
                            <div class="card h-md-100">
                                <div class="card-body d-flex flex-column flex-center py-10">
                                    <div class="mb-2">
                                        <h2 class="text-gray-800 text-center lh-lg">No Match Found</h2>
                                        <div class="py-10 text-center">
                                            <img src="{{ asset('admin/media/svg/illustrations/easy-2/4.svg') }}" class="w-200px" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
    <!--begin::Sidebar-->
    <div class="col-md-4">
        <!--begin::Pos order-->
        <div class="card card-flush bg-body " id="kt_pos_form">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <h3 class="card-title fw-bold text-gray-800">Items Selected</h3>
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <form
                        action="{{ route('api.cart.destroy') }}"
                        x-data x-submit wire:finish="$refresh" method="POST"
                    >
                        @method('delete')
                        <button
                            type="submit" class="btn btn-sm btn-light-primary fw-bold py-4"
                            @disabled(cart()->products->isEmpty())
                        >
                            Clear All
                        </button>
                    </form>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0">
                <!--begin::Table container-->
                <div class="table-responsive mb-8">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4 my-0">
                        <thead>
                        <tr>
                            <th></th>
                            <th class="w-100px"></th>
                            <th class="w-40px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(cart()->products as $product)
                            <tr data-kt-pos-element="item" data-kt-pos-item-price="33">
                                <td class="pe-0">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('shop.show', $product) }}" data-bs-toggle="tooltip" title="{{ $product->name }}">
                                            <img src="{{ $product->images->first()?->thumbnail }}" class="w-50px h-50px rounded-3 me-3" alt=""/>
                                            <span class="fw-bold text-gray-800 text-hover-primary d-md-none">
                                                {{ str($product->name)->limit(30) }}
                                            </span>
                                        </a>
                                    </div>
                                </td>
                                <td class="pe-0">
                                    <form action="{{ route('api.products.cart.update', $product) }}"
                                          x-submit data-quietly
                                          x-data="{ quantity: {{ $product->quantity }} }"
                                          @change="$dispatch('submit')"
                                          wire:finish="$refresh"
                                    >
                                        @method('PUT')
                                        <div class="position-relative d-flex align-items-center">
                                            <button
                                                class="btn btn-icon btn-sm btn-light btn-icon-gray-400"
                                                @click="quantity > 1 && quantity--"
                                            >
                                                <i class="bi bi-dash fs-1"></i>
                                            </button>
                                            <input type="number" class="form-control border-0 text-center px-0 fw-bold text-gray-800 w-45px" name="quantity" x-model="quantity" value="{{ $product->quantity }}" min="1">
                                            <button class="btn btn-icon btn-sm btn-light btn-icon-gray-400" @click="quantity++">
                                                <i class="bi bi-plus fs-1"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="pe-0">
                                    <span class="fw-bold text-primary fs-3">
                                        ₦{{ number_format($product->price * $product->quantity) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('api.products.cart.destroy', $product) }}"
                                          x-submit method="POST" wire:finish="$refresh" data-quietly
                                    >
                                        @method('delete')
                                        <button class="btn p-1" data-bs-toggle="tooltip" title="Remove product from cart">
                                            <i class="bi bi-x-circle-fill text-danger fs-3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
                <!--begin::Summary-->
                <div class="d-flex flex-stack bg-success rounded-3 p-6 mb-11">
                    <div class="fs-5 fw-bold text-white">
                        <span class="d-block lh-1 mb-2">Subtotal</span>
                        <span class="d-block mb-2">Voucher</span>
                        <span class="d-block mb-9">VAT</span>
                        <span class="d-block fs-2 lh-1">Total</span>
                    </div>
                    <div class="fs-5 fw-bold text-white text-end">
                        <span class="d-block lh-1 mb-2" data-kt-pos-element="total">₦{{ number_format(cart()->amount()) }}</span>
                        <span class="d-block mb-2" data-kt-pos-element="discount">0</span>
                        <span class="d-block mb-9" data-kt-pos-element="tax">0</span>
                        <span class="d-block fs-2 lh-1" data-kt-pos-element="grant-total">₦{{ number_format(cart()->amount()) }}</span>
                    </div>
                </div>
                <!--end::Summary-->
                <!--begin::Payment Method-->
                <div class="m-0">
                    <button
                        data-bs-toggle="modal" data-bs-target="#checkout-modal"
                        class="btn btn-primary fs-1 w-100 py-4"
                        @disabled(cart()->isEmpty())
                    >
                        Checkout
                    </button>
                </div>
            </div>
            <!--end: Card Body-->
        </div>
        <!--end::Pos order-->
    </div>
    <!--end::Sidebar-->

    <!--begin:: checkout modal-->
    <div class="modal fade" id="checkout-modal" tabindex="-1" aria-labelledby="checkout-label" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkout-label">Customer Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" x-data="{ type : 'pickup', user : 'existing' }">
                    <form x-submit action="{{ route('api.pos.store') }}" id="checkout-form" method="POST">
                        <div class="fv-row mb-10">
                            <div class="row" data-kt-buttons="true" data-kt-buttons-target=".user">
                                <div class="col-12 col-md-6 mb-5">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-4 user">
                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-center">
                                            <input class="form-check-input" type="radio" name="customer" value="existing" checked="checked" x-model="user">
                                        </span>
                                        <span class="ms-5">
                                            <span class="fs-6 fw-bold text-gray-800 d-block">Existing Customer</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-12 col-md-6 mb-5">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-4 user">
                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start">
                                            <input class="form-check-input" type="radio" name="customer" value="new" x-model="user">
                                        </span>
                                        <span class="ms-5">
                                            <span class="fs-6 fw-bold text-gray-800 d-block">New Customer</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-10" x-show="user === 'existing'" x-transition>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="user">Select Customer</label>
                                <select class="form-select" id="user" data-control="select2" data-placeholder="Select a Customer" name="user_id" data-dropdown-parent="#checkout-modal">
                                    <option></option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name .' - '. $user->phone }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-10" x-show="user === 'new'" x-transition>
                            <div class="mb-5 col-md-6">
                                <label class="form-label required" for="phone">Phone</label>
                                <input class="form-control" type="tel" name="phone" id="phone">
                            </div>
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="email">Email Address</label>
                                <input class="form-control" type="email" name="email" id="email">
                            </div>
                            <div class="mb-5 col-md-4">
                                <label class="form-label required" for="first-name">First Name</label>
                                <input class="form-control" type="text" name="first_name" id="first-name">
                            </div>
                            <div class="mb-5 col-md-4">
                                <label class="form-label" for="last-name">Last Name</label>
                                <input class="form-control" type="text" name="last_name" id="last-name">
                            </div>
                            <div class="mb-5 col-md-4">
                                <label class="form-label required" for="gender">Gender</label>
                                <select class="form-select" name="gender" id="gender" required>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="fv-row mb-10">
                            <div class="row" data-kt-buttons="true" data-kt-buttons-target=".delivery-type">
                                <label class="form-label">Delivery Type</label>
                                <div class="col-12 col-md-6 mb-5">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-4 delivery-type">
                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-center">
                                            <input class="form-check-input" type="radio" name="delivery_type" value="pickup" checked="checked" x-model="type">
                                        </span>
                                        <span class="ms-5">
                                            <span class="fs-6 fw-bold text-gray-800 d-block">Pickup</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-12 col-md-6 mb-5">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-4 delivery-type">
                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start">
                                            <input class="form-check-input" type="radio" name="delivery_type" value="delivery" x-model="type">
                                        </span>
                                        <span class="ms-5">
                                            <span class="fs-6 fw-bold text-gray-800 d-block">Delivery</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div x-show="type === 'delivery'" x-transition>
                            <div class="mb-5">
                                <label class="form-label" for="address">Delivery Address</label>
                                <textarea class="form-control" id="address" name="delivery_address"></textarea>
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="delivery-fee">Delivery fee</label>
                                <div class="input-group">
                                    <span class="input-group-text text-muted">₦</span>
                                    <input class="form-control" type="number" name="delivery_fee" id="delivery-fee">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="checkout-form">Place Order</button>
                </div>
            </div>
        </div>
    </div>
    <!--end:: checkout modal-->
</div>
