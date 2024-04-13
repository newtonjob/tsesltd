<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class);

        $this->middleware('cart.filled')->only('store');
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $request->fulfill();

        return Response::api('Order placed!', headers: [
            'x-location' => route('orders.show', $order)
        ]);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return Response::api('Updated Successfully!');
    }

    public function destroy(Order $order)
    {
        $order->deleteOrFail();

        return Response::api('Order cancelled successfully' , headers: [
            'x-location' => route('orders.index')
        ]);
    }
}
