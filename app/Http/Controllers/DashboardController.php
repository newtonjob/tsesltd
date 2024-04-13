<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $orders             = user()->isAdmin() ? Order::take(50)->latest()->get() : user()->orders()->latest()->get();
        $customers_count    = User::customer()->count();
        $products_count     = Product::count();
        $orders_count       = Order::count();
        $awaiting_delivery  = Order::whereDeliveredAt(null)->count();

        return view('dashboard.index',
            compact(['orders', 'customers_count', 'products_count', 'orders_count', 'awaiting_delivery'])
        );
    }
}
