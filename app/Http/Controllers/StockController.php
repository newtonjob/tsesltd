<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Product;

class StockController extends Controller
{
    public function create()
    {
        $this->authorize('manage-stock');

        $products  = Product::all();
        $locations = Location::all();

        return view('stock.create', compact(['products', 'locations']));
    }
}
