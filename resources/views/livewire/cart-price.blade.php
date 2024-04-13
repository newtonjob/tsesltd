<tag x-data @cart-updated.window="$wire.call('$refresh')">
    ₦{{ number_format(cart()->amount()) }}
</tag>
