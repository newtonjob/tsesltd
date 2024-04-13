<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DispatchedOrderController extends Controller
{
    public function __invoke(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $order->products()->syncWithoutDetaching($request->products);

        return Response::api('Dispatched Successfully');
    }
}
