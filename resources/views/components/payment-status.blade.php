<span @class([
        'badge',
        'badge-light-warning' => ! $order->isPaid(),
        'badge-light-success' => $order->isPaid()
])>
    {{ $order->isPaid() ? 'Fully Paid' : 'Pending Payment' }}
</span>
