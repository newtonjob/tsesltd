<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class GlobalSearch extends Component
{
    public $search;

    public function render()
    {
        $users      = $this->search ? User::search($this->search)->take(5)->get() : collect();
        $orders     = $this->search ? Order::search($this->search)->take(5)->get() : collect();
        $products   = $this->search ? Product::search($this->search)->whereHas('image')->take(5)->get() : collect();

        return view('livewire.global-search', compact(['users', 'orders', 'products']));
    }
}
