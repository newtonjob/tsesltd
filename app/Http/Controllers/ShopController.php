<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        $products = Product::whereHas('image')->search()->filter()->paginate(16);

        return view('shop.index', compact('products'));
    }

    public function show(Product $product): View
    {
        $product->load(['subCategory.products' => fn ($query) => $query->has('image')->take(10)]);

        $recommendedProducts = Product::whereHas('image')->inRandomOrder()->take(10)->get();

        return view('shop.show', compact('product', 'recommendedProducts'));
    }
}
