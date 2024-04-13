<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class);
    }

    public function index()
    {
        $orders = Order::with('products', 'transactions')->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['paidTransactions.creator', 'products.locations' => fn ($query) => $query->where('quantity', '>', 0)]);

        return view('orders.show', compact('order'));
    }
}
