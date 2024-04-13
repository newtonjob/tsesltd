<div>
    <div class="thumb pb30">
        @if($product->discount > 0)
            <h3 class="badge" style="background-color: #f5c34b; color: black; padding: 10px; position: absolute; left: 20px;" >
                -{{ $product->discount }}%
            </h3>
        @endif
        <a href="{{ route('shop.show', $product) }}">
            <img src="{{ $product->image?->medium }}" alt="product image">
        </a>
        <div class=thumb_info>
            <ul class=mb0>
                <li>
                    <a href="#" title="Add to Wishlist">
                        <span class=flaticon-heart></span>
                    </a>
                </li>
                <li>
                    <a href="#" title="quick view">
                        <span class=flaticon-show></span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class=flaticon-graph></span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shop_item_cart_btn d-grid">
            <form action="{{ route('api.products.cart.store', $product) }}" method="post" x-data x-submit @finish="$dispatch('cart-updated')">
                <button class="btn btn-thm btn-lg w-100">Add to Cart</button>
            </form>
        </div>
    </div>
    <div class=details>
        <a href="{{ route('shop.index', ['brand' => $product->brand]) }}" class=sub_title>{{ $product->brand?->name }} &nbsp;</a>
        <div class="title title-56">
            <a href="{{ route('shop.show', $product) }}">{{ $product->name }}</a>
        </div>
        <div class=si_footer>
            <div class=price>
                ₦{{ number_format($product->price) }}
                @if($product->discount > 0)
                    <small>
                        <del>₦{{ number_format($product->initialPrice) }}</del>
                    </small>
                @endif
            </div>
        </div>
    </div>
</div>
