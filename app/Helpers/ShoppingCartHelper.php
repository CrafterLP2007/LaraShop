<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class ShoppingCartHelper
{
    protected array $items = [];

    public function __construct()
    {
        $this->items = Session::get('cart_items', []);
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

        Session::put('cart_items', $this->items);
    }

    public function removeProduct(string $productId, int $amount = 1): void
    {
        if (isset($this->items[$productId])) {
            if ($this->items[$productId]['amount'] > $amount) {
                $this->items[$productId]['amount'] -= $amount;
            } else {
                unset($this->items[$productId]);
            }
        }

        Session::put('cart_items', $this->items);
    }

    public function clear(): void
    {
        if (Session::has('cart_items')) {
            Session::forget('cart_items');
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

    public function getItems(): Collection
    {
        return collect($this->items);
    }
}
