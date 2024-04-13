<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class SiteSearch extends Component
{
    public $search;

    public function mount()
    {
        $this->search = request('q');
    }

    public function render()
    {
        $products = Product::search($this->search)->take(5)->get();

        return view('livewire.site-search', compact('products'));
    }
}
