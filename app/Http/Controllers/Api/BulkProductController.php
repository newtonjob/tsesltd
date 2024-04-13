<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class BulkProductController
{
    public function update(Request $request)
    {
        Gate::authorize('manage-shop');

        $values = $request->collect('products');

        Product::whereKey($values->keys())->each(
            fn ($product) => $product->update($values[$product->id])
        );

        return Response::api('Updated successfully');
    }
}
