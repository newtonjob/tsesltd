<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function destroy()
    {
        cart()->empty();

        return Response::api('Cart cleared');
    }
}
