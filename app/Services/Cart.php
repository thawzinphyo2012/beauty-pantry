<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class Cart
{
    public const FREE_SHIPPING_FROM = 150000;

    public const SHIPPING_FEE = 5000;

    private const KEY = 'beauty_pantry_cart';

    public function raw(): array
    {
        return session(self::KEY, []);
    }

    public function lines(): Collection
    {
        $items = $this->raw();

        if ($items === []) {
            return collect();
        }

        $products = Product::with('category')->whereIn('id', array_keys($items))->get()->keyBy('id');

        return collect($items)
            ->map(function (int $quantity, int|string $id) use ($products) {
                $product = $products->get((int) $id);

                if (! $product) {
                    return null;
                }

                $quantity = max(1, min($quantity, $product->stock));

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'line_total' => $product->price * $quantity,
                ];
            })
            ->filter()
            ->values();
    }

    public function add(Product $product, int $quantity = 1): void
    {
        $items = $this->raw();
        $current = $items[$product->id] ?? 0;
        $items[$product->id] = min($product->stock, $current + max(1, $quantity));
        session([self::KEY => $items]);
    }

    public function update(Product $product, int $quantity): void
    {
        $items = $this->raw();

        if ($quantity < 1) {
            unset($items[$product->id]);
        } else {
            $items[$product->id] = min($product->stock, $quantity);
        }

        session([self::KEY => $items]);
    }

    public function remove(Product $product): void
    {
        $items = $this->raw();
        unset($items[$product->id]);
        session([self::KEY => $items]);
    }

    public function clear(): void
    {
        session()->forget(self::KEY);
    }

    public function count(): int
    {
        return (int) $this->lines()->sum('quantity');
    }

    public function subtotal(): int
    {
        return (int) $this->lines()->sum('line_total');
    }

    public function shipping(): int
    {
        $subtotal = $this->subtotal();

        if ($subtotal === 0) {
            return 0;
        }

        return $subtotal >= self::FREE_SHIPPING_FROM ? 0 : self::SHIPPING_FEE;
    }

    public function total(): int
    {
        return $this->subtotal() + $this->shipping();
    }
}
