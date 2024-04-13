<?php

namespace App\Http\Middleware;

use App\Support\Cart;
use Closure;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Symfony\Component\HttpFoundation\Response;

class InitializeCart
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cart = new Cart;

        Event::listen(function (Login $event) use ($cart) {
            $cart->merge(new Cart($key = $event->user->getKey()))->setKey($key);
        });

        app()->instance(Cart::class, $cart);

        return $next($request);
    }
}
