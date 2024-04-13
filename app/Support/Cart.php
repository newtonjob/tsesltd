<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * @mixin Collection
 */
class Cart
{
    /**
     * All the products in the cart.
     */
    public Collection $products;

    public function __construct(protected $key = null)
    {
        $this->key ??= (Auth::id() ?? session()->getId());

        $this->products = Cache::get($this->cacheKey(), new Collection);
    }

    /**
     * Set the key for the cache.
     */
    public function setKey(int|string $key): static
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get the cache key to be used to store the cart.
     */
    public function cacheKey(): string
    {
        return "cart:{$this->key}";
    }

    /**
     * Add the given product to the cart.
     */
    public function add(Product $product, int $quantity = null): static
    {
        $quantity ??= request('quantity', 1);

        $this->products->when(
            fn ($products) => $products->contains($product),

            function ($products) use ($product, $quantity) {
                $products->find($product)->quantity += $quantity;
            },

            function ($products) use ($product, $quantity) {
                $products->add(tap($product, fn ($product) => $product->quantity = $quantity));
            }
        );

        return $this;
    }

    /**
     * Merge the given cart into the current cart.
     */
    public function merge(Cart $cart): static
    {
        $cart->each(fn ($product) => $this->add($product, $product->quantity));

        return $this;
    }

    /**
     * Remove the given product from the cart.
     */
    public function remove(Product $product): static
    {
        $this->products = $this->products->except($product->id);

        return $this;
    }

    /**
     * Replace the quantity in cart for the given product with the given quantity.
     */
    public function sync(Product $product, int $quantity = null): void
    {
        $quantity ??= request('quantity', 1);

        $this->products->find($product)->quantity = $quantity;
    }

    /**
     * Get the total amount of products in the cart.
     */
    public function amount(): mixed
    {
        return $this->products->sum(
            fn ($product) => $product->price * $product->quantity
        );
    }

    /**
     * Empty the cart.
     */
    public function empty(): static
    {
        $this->products = Collection::empty();

        return $this;
    }

    public function __get(string $key)
    {
        return $this->products->{$key};
    }

    public function __call(string $method, array $parameters)
    {
        return $this->products->{$method}(...$parameters);
    }

    public function __destruct()
    {
        Cache::put($this->cacheKey(), $this->products);
    }
}
