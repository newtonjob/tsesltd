<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Enums\Ability;
use App\Models\SubCategory;
use Illuminate\Auth\Middleware\Authorize;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-shop')
        );
    }

    public function index()
    {
        $categories = Category::with('subCategories')->withCount('products')->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $subCategories  = SubCategory::all();

        return view('categories.create', compact('subCategories'));
    }

    public function edit(Category $category)
    {
        $subCategories  = SubCategory::all();

        return view('categories.edit', compact('subCategories', 'category'));
    }
}
