<?php

namespace App\Services\Cart;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ShoppingCartService
{
    protected array $items = [];

    public function __construct()
    {
        $this->items = Session::get('cart', []);
    }

    public function addProduct(Product $product, int $amount = 1): void
    {
        $productId = $product->id;

        if (isset($this->items[$productId])) {
            $this->items[$productId]['amount'] += $amount;
        } else {
            $this->items[$productId] = [
                'product' => $product,
                'amount' => $amount
            ];
        }

        Session::put('cart', ['cart_items' => $this->items]);
    }

    public function removeProduct(Product $product, int $amount = 1): void
    {
        $productId = $product->id;

        if (isset($this->items[$productId])) {
            if ($this->items[$productId]['amount'] > $amount) {
                $this->items[$productId]['amount'] -= $amount;
            } else {
                unset($this->items[$productId]);
            }
        }

        Session::put('cart', ['cart_items' => $this->items]);
    }

    public function clear(): void
    {
        if (Session::has('cart')) {
            Session::forget('cart');
        }
    }

    public function getTotalPrice(): float
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $totalPrice += $item['product']->price * $item['amount'];
        }

        return $totalPrice;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
