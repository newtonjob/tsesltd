<div class="menu-item p-3" x-data @cart-updated.window="$wire.call('$refresh')">
    @unless(cart()->isEmpty())
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <tbody class="fw-semibold text-gray-600">
            @foreach(cart()->products as $product)
                <tr>
                    <td class="mn-w-300px">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('products.edit', $product) }}" class="symbol symbol-50px">
                                <span class="symbol-label" style="background-image:url({{ $product->image?->thumbnail }});"></span>
                            </a>
                            <div class="ms-5">
                                <a href="{{ route('products.edit', $product) }}" class="text-gray-800 text-hover-primary fs-8 fw-bold">
                                    {{ $product->name }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="w-60px w-md-80px">
                        <form action="{{ route('api.products.cart.update', $product) }}"
                              x-data x-submit @change="$dispatch('submit')" @finish="$dispatch('cart-updated')" data-quietly
                        >
                            @method('PUT')
                            <input class="form-control" name="quantity" value="{{ $product->quantity }}"
                                   type="number" aria-label="quantity" min="1"
                            >
                        </form>
                    </td>
                    <td class="text-end">₦{{ number_format($product->price * $product->quantity) }}</td>
                </tr>
            @endforeach
            <tr>
                <td>Total</td>
                <td colspan="2" class="text-end">₦{{ number_format(cart()->amount()) }}</td>
            </tr>
            </tbody>
        </table>
        <div class="separator my-2"></div>
        <div class="menu-item px-3">
            <div class="menu-content px-3 text-center">
                <button data-bs-toggle="modal" data-bs-target="#checkout-modal" class="btn btn-success btn-sm">Checkout</button>
                <a href="{{ route('cart') }}" class="btn btn-primary btn-sm ms-3">View Cart</a>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body d-flex flex-column flex-center py-10">
                <div class="mb-2">
                    <h2 class="text-gray-800 text-center lh-lg">Your cart is empty</h2>
                    <div class="py-10 text-center">
                        <img src="{{ asset('admin/media/svg/illustrations/easy/3.svg') }}" class="w-200px" alt="">
                    </div>
                    <div class="text-center mb-1">
                        <a class="btn btn-sm btn-primary" href="{{ route('shop.index') }}">Start shopping</a>
                    </div>
                </div>
            </div>
        </div>
    @endunless
</div>
