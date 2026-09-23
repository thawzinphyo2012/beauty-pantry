<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->with('category')
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($category) => $category->where('slug', $request->string('category')));
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = '%'.$request->string('q').'%';
                $query->where(function ($inner) use ($term) {
                    $inner->where('name', 'like', $term)
                        ->orWhere('subtitle', 'like', $term)
                        ->orWhere('description', 'like', $term);
                });
            })
            ->when($request->string('sort')->toString() === 'price_asc', fn ($query) => $query->orderBy('price'))
            ->when($request->string('sort')->toString() === 'price_desc', fn ($query) => $query->orderByDesc('price'))
            ->when($request->string('sort')->toString() === 'newest', fn ($query) => $query->latest())
            ->when(! in_array($request->string('sort')->toString(), ['price_asc', 'price_desc', 'newest'], true), function ($query) {
                $query->orderByDesc('is_featured')->orderBy('name');
            })
            ->paginate(8)
            ->withQueryString();

        return view('store.shop.index', [
            'products' => $products,
            'categories' => Category::orderBy('sort')->get(),
            'activeCategory' => $request->string('category')->toString(),
        ]);
    }

    public function show(Product $product)
    {
        $product->load('category');

        $related = Product::with('category')
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->take(4)
            ->get();

        return view('store.shop.show', [
            'product' => $product,
            'related' => $related,
        ]);
    }
}
