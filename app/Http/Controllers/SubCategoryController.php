<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Auth\Middleware\Authorize;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-shop')
        );
    }

    public function index()
    {
        $subCategories  = SubCategory::with('category')->withCount('products')->get();
        $categories     = Category::all();

        return view('sub-categories.index', compact('subCategories', 'categories'));
    }
}
