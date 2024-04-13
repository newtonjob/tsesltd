<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePosOrderRequest;
use Illuminate\Http\Response;

class PosOrderController extends Controller
{
    public function store(StorePosOrderRequest $request)
    {
        $order = $request->fulfill();

        return Response::api('Order placed!', headers: [
            'x-location' => route('orders.show', $order)
        ]);
    }
}
