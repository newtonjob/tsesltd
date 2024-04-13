<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Location;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Auth\Middleware\Authorize;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-shop')
        );
    }

    public function index()
    {
        $products = Product::withStock()->filter()->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $subCategories  = SubCategory::with('category')->get();
        $brands         = Brand::all();
        $locations      = Location::all();

        return view('products.create', compact('subCategories', 'brands', 'locations'));
    }

    public function edit(Product $product)
    {
        $product->load(['orders' => fn ($query) => $query->with('user')->withLocationName()->latest()]);

        $subCategories  = SubCategory::with('category')->get();
        $brands         = Brand::all();
        $locations      = Location::all();

        return view('products.edit', compact('product', 'subCategories', 'brands', 'locations'));
    }
}
