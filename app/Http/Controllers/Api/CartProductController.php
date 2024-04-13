<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartProductController extends Controller
{
    public function store(Product $product)
    {
        $product->addToCart();

        return Response::api("{$product->name} has been added to your cart.");
    }

    public function update(Request $request, Product $product)
    {
        $request->validate(['quantity' => 'integer|min:1']);

        $product->syncInCart();

        return Response::api("We've updated your cart.");
    }

    public function destroy(Product $product)
    {
        $product->removeFromCart();

        return Response::api("{$product->name} has been removed to your cart.");
    }
}
