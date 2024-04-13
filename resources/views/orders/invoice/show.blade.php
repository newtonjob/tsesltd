@if(request()->has('tses'))
    @include('orders.invoice.partials.tses')
@else()
    @include('orders.invoice.partials.bensu')
@endif
