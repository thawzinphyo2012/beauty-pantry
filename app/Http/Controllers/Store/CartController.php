<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Cart $cart)
    {
        return view('store.cart.index', [
            'lines' => $cart->lines(),
            'cart' => $cart,
        ]);
    }

    public function store(Request $request, Cart $cart)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:8'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        if (! $product->inStock()) {
            return back()->with('status', $product->name.' is resting — currently out of stock.');
        }

        $cart->add($product, (int) ($data['quantity'] ?? 1));

        return back()->with('status', $product->name.' was placed in your bag.');
    }

    public function update(Request $request, Product $product, Cart $cart)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:0', 'max:8'],
        ]);

        $cart->update($product, (int) $data['quantity']);

        return back();
    }

    public function destroy(Product $product, Cart $cart)
    {
        $cart->remove($product);

        return back()->with('status', $product->name.' was removed from your bag.');
    }
}
