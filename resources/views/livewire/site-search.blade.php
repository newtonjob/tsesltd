<div class="box-search">
    <input class="form_control" name="q" placeholder="Search products…" aria-label="search"
           value="{{ request('q') }}" wire:model="search" minlength="2" style="min-width: 295px;">
    <div class="search-suggestions" wire:ignore.self>
        <div class="box-suggestions">
            <ul>
                @foreach($products as $product)
                    <a href="{{ route('shop.show', $product) }}">
                        <li>
                            <div class="thumb">
                                <img src="{{ $product->image?->thumbnail }}" alt="{{ $product->name }}">
                            </div>
                            <div class="info-product">
                                <div class="item_title">{{ $product->name }}</div>
                                <div class="price">
                                    <span class="sale">
                                        ₦{{ number_format($product->price) }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
</div>
