<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('store.home', [
            'categories' => Category::orderBy('sort')->get(),
            'featured' => Product::with('category')->where('is_featured', true)->latest()->take(4)->get(),
            'bestsellers' => Product::with('category')->where('is_bestseller', true)->take(4)->get(),
        ]);
    }
}
