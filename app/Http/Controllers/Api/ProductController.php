<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-shop')
        );
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        return Response::api('Added Successfully', headers: [
            'x-location' => route('products.edit', $product)
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return Response::api('Updated Successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return Response::api('Product Deleted', headers: [
            'x-location' => route('products.index')
        ]);
    }
}
