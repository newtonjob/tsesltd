<?php

namespace App\Http\Controllers;

use App\Models\Enums\Ability;
use App\Models\Product;
use Illuminate\Auth\Middleware\Authorize;

class BulkProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-shop')
        );
    }

    public function index()
    {
        $products = Product::withStock()->get();

        return view('bulk-products.index', compact('products'));
    }
}
