<div class=cart-hidden-sbar>
    <div class=hsidebar-header>
        <div class=sidebar-close-icon><span class=flaticon-close></span></div>
        <h4 class=title>Your Cart</h4>
    </div>
    <div class=hsidebar-content>
        <div class="log_fav_cart_widget hsidebar_home_page">
            <div class=wrapper>
                <ul class=cart>
                    <li class=list-inline-item>
                        <ul class=dropdown_content>
                            @foreach(cart()->products as $product)
                                <li class=list_content>
                                    <div>
                                        <a href="{{ route('shop.show', $product) }}">
                                            <img class="float-start mt10" src="{{ $product->image?->thumbnail }}" alt="">
                                            <p data-bs-toggle="tooltip" title="{{ $product->name }}">{{ str($product->name)->limit(35) }}</p>
                                        </a>
                                        <div class="cart_btn home_page_sidebar mt10">
                                            <form action="{{ route('api.products.cart.update', $product) }}" x-data x-submit @change="$dispatch('submit')">
                                                @method('PUT')
                                                <div class="quantity-block home_page_sidebar" x-data="{ quantity: {{ $product->quantity }} }">
                                                    <button class="quantity-arrow-minus home_page_sidebar" @click="quantity > 1 && quantity--">
                                                        <img src="{{ asset('images/icons/minus.svg') }}" alt="">
                                                    </button>
                                                    <input class="quantity-num home_page_sidebar" type="number" name="quantity" x-model="quantity" aria-label="quantity" min="1">
                                                    <button class="quantity-arrow-plus home_page_sidebar" @click="quantity++">
                                                        <span class="flaticon-close"></span>
                                                    </button>
                                                </div>
                                            </form>
                                            <span class="home_page_sidebar price">₦{{ number_format($product->price * $product->quantity) }}</span>
                                        </div>
                                        <form action="{{ route('api.products.cart.destroy', $product) }}" x-data x-submit data-confirm method="POST">
                                            @method('DELETE')
                                            <button class="close_icon btn p-1"><i class="flaticon-close"></i></button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                            <li class="list_content_total_price mb-5 pb-5">
                                <h5>Total: <span class="total_price float-end">₦{{ number_format(cart()->amount()) }}</span></h5>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class=hsidebar_footer_content>
                    <div class=list_last_content>
                        <div class=lc>
                            <a href="{{ route('cart') }}" class="cart_btns btn btn-white">View Cart</a>
                            <a href="{{ route('checkout') }}" class="checkout_btns btn btn-thm">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
