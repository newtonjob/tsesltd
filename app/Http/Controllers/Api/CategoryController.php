<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CategoryController
{
    public function __construct()
    {
        Gate::authorize('manage-shop');
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->safe()->except('sub_categories'));

        $category->subCategories()->createMany(
            $request->collect('sub_categories')
        );

        return Response::api('Created Successfully', headers: [
            'x-location' => route('categories.index')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->safe()->except('sub_categories'));

        $category->subCategories()->createMany(
            $request->collect('sub_categories')
        );

        return Response::api('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return Response::api('Deleted Successfully.');
    }
}
