<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-shop')
        );
    }

    public function store(Request $request, Product $product)
    {
        $product->images()->create(['src' => $request->file]);

        return Response::api('Uploaded successfully');
    }

    public function destroy(Image $image)
    {
        $image->delete();

        return Response::api('Deleted successfully');
    }
}
