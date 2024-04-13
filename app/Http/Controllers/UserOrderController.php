<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserOrderController extends Controller
{
    public function index(User $user)
    {
        $this->authorize('view', $user);

        $orders = $user->orders->load('user', 'products', 'transactions')->sortByDesc('id');

        return view('orders.index', compact('orders'));
    }
}
