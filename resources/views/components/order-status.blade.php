<span @class([
    'badge',
    'badge-light-warning' => ! $order->isDelivered(),
    'badge-light-success' => $order->isDelivered(),
])>
    {{ $order->isDelivered() ? 'Delivered' : 'Processing Delivery' }}
</span>
