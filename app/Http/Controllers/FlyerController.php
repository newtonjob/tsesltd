<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FlyerController extends Controller
{
    public function index() {
        $this->authorize('manage-shop');

        $products = Product::get();

        return view('flyers.index', compact('products'));
    }
}
