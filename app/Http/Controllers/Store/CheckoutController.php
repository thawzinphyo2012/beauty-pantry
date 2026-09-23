<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Services\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function create(Cart $cart)
    {
        $lines = $cart->lines();

        if ($lines->isEmpty()) {
            return redirect()->route('cart')->with('status', 'Your bag is empty. Choose a ritual first.');
        }

        return view('store.checkout.create', [
            'lines' => $lines,
            'cart' => $cart,
        ]);
    }

    public function store(Request $request, Cart $cart)
    {
        $lines = $cart->lines();

        if ($lines->isEmpty()) {
            return redirect()->route('shop');
        }

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:40'],
            'city' => ['required', 'string', 'max:80'],
            'address' => ['required', 'string', 'max:240'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $order = DB::transaction(function () use ($data, $lines, $cart, $request) {
            foreach ($lines as $line) {
                $product = Product::whereKey($line['product']->id)->lockForUpdate()->first();

                if (! $product || $product->stock < $line['quantity']) {
                    throw ValidationException::withMessages([
                        'address' => ($product->name ?? 'An item').' no longer has enough stock. Please review your bag.',
                    ]);
                }
            }

            $order = Order::create([
                ...$data,
                'user_id' => $request->user()?->id,
                'number' => 'BP-'.now()->format('ymd').'-'.strtoupper(Str::random(4)),
                'status' => 'pending',
                'subtotal' => $cart->subtotal(),
                'shipping' => $cart->shipping(),
                'total' => $cart->total(),
            ]);

            foreach ($lines as $line) {
                $product = Product::whereKey($line['product']->id)->lockForUpdate()->first();
                $product->decrement('stock', $line['quantity']);

                $order->items()->create([
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $line['quantity'],
                ]);
            }

            return $order;
        });

        $cart->clear();

        return redirect()->route('orders.success', $order);
    }

    public function success(Order $order)
    {
        $order->load('items');

        return view('store.checkout.success', [
            'order' => $order,
        ]);
    }
}
