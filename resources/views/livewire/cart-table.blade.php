<div class="row mt15" x-data @cart-updated.window="$wire.call('$refresh')">
    <div class="col-lg-8 col-xl-9">
        <div class="shopping_cart_table table-responsive">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th scope="col">PRODUCT</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="table_body">
                @foreach(cart()->products as $product)
                    <tr>
                        <th scope="row">
                            <ul class="cart_list d-block d-xl-flex">
                                <li class="ps-1 ps-sm-4 pe-1 pe-sm-4"><a href="#"><img src="{{ $product->image?->thumbnail }}" alt="cart1.png"></a></li>
                                <li class="ms-2 ms-md-3">
                                    <a class="cart_title" href="#">
                                        {{ $product->name }}
                                    </a>
                                </li>
                            </ul>
                        </th>
                        <td>₦{{ number_format($product->price) }}</td>
                        <td>
                            <form action="{{ route('api.products.cart.update', $product) }}" x-submit x-data="{ quantity: {{ $product->quantity }} }" @change="$dispatch('submit')" @finish="$dispatch('cart-updated')" data-quietly>
                                @method('PUT')
                                <div class="cart_btn">
                                    <div class="quantity-block" x-data="{ quantity: {{ $product->quantity }} }">
                                        <button class="quantity-arrow-minus2 inner_page" @click="quantity > 1 && quantity--">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                        <input class="quantity-num2 inner_page" type="number" name="quantity"
                                               x-model="quantity" aria-label="quantity" min="1"
                                        >
                                        <button class="quantity-arrow-plus2 inner_page" @click="quantity++">
                                            <span class="fas fa-plus"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="">₦{{ number_format($product->price * $product->quantity) }}</td>
                        <td class="">
                            <form action="{{ route('api.products.cart.destroy', $product) }}" x-data x-submit data-confirm method="POST" @finish="$dispatch('cart-updated')">
                                @method('delete')

                                <button class="close_icon btn p-1"><i class="flaticon-close"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-4 col-xl-3">
        <div class="order_sidebar_widget style2">
            <h4 class="title">Cart Breakdown</h4>
            <ul>
                <li class="subtitle">
                    <p>
                        Subtotal <span class="float-end">₦{{ number_format(cart()->amount()) }}</span>
                    </p>
                </li>
                <li class="subtitle"><p>VAT (0%) <span class="float-end">₦0</span></p></li>
                <li class="subtitle"><p>Delivery <span class="float-end">Free</span></p></li>
                <li class="subtitle"><hr></li>
                <li class="subtitle totals">
                    <p>
                        Total <span class="float-end">₦{{ number_format(cart()->amount()) }}</span>
                    </p>
                </li>
            </ul>
            <div class="ui_kit_button payment_widget_btn">
                <a href="{{ route('checkout') }}" type="button" class="btn btn-thm btn-block">Proceed to checkout</a>
            </div>
        </div>
    </div>
</div>
