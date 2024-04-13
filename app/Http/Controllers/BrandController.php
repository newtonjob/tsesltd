<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Enums\Ability;
use App\Models\Product;
use Illuminate\Auth\Middleware\Authorize;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-shop')
        );
    }

    public function index()
    {
        $brands = Brand::withCount('products')->get();

        return view('brands.index', compact('brands'));
    }
}
