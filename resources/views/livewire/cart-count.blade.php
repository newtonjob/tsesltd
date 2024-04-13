<tag x-data @cart-updated.window="$wire.call('$refresh')">
    {{ cart()->products->count() }}
</tag>
