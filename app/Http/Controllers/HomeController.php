<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;

class HomeController extends Controller
{
    public function __invoke()
    {
        $discountedProducts = Product::discounted()->whereHas('image')->get();
        $latestProducts     = Product::latest()->whereHas('image')->take(12)->get();
        $bestSellers        = Product::whereHas('image')->withCount('orders')->latest('orders_count')->take(20)->get();

        return view('home', compact(['discountedProducts', 'bestSellers', 'latestProducts']));
    }
}
