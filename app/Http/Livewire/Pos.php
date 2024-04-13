<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Livewire\Component;

class Pos extends Component
{
    public $search;

    public $subCategory;

    public function render()
    {
        $products = Product::with('subCategory')
            ->search($this->search)
            ->when($this->subCategory)
            ->where('sub_category_id', $this->subCategory)
            ->take(9)
            ->get();

        $users = User::customer()->get();
        $subCategories = SubCategory::all();

        return view('livewire.pos', compact('products', 'subCategories', 'users'));
    }
}
