<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::with('category')->latest()->paginate(12),
        ]);
    }

    public function create()
    {
        return view('admin.products.form', [
            'product' => new Product(['stock' => 10]),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['name']);
        $data['image'] = $this->storeImage($request);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('status', 'Product added to the pantry.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', [
            'product' => $product,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request, $product);
        $data['slug'] = $this->uniqueSlug($data['name'], $product->id);

        if ($request->hasFile('image')) {
            $this->deleteStoredImage($product->image);
            $data['image'] = $this->storeImage($request);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('status', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $this->deleteStoredImage($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Product removed.');
    }

    private function validated(Request $request, ?Product $product = null): array
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:140'],
            'subtitle' => ['nullable', 'string', 'max:180'],
            'description' => ['required', 'string', 'max:4000'],
            'story' => ['nullable', 'string', 'max:4000'],
            'ingredients' => ['nullable', 'string', 'max:4000'],
            'how_to' => ['nullable', 'string', 'max:4000'],
            'price' => ['required', 'integer', 'min:0'],
            'compare_price' => ['nullable', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'sku' => ['nullable', 'string', 'max:40', Rule::unique('products', 'sku')->ignore($product?->id)],
            'badge' => ['nullable', 'string', 'max:40'],
            'image' => [$product ? 'nullable' : 'nullable', 'image', 'max:4096'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_bestseller'] = $request->boolean('is_bestseller');
        unset($data['image']);

        return $data;
    }

    private function uniqueSlug(string $name, ?int $ignore = null): string
    {
        $base = Str::slug($name) ?: 'product';
        $slug = $base;
        $i = 2;

        while (Product::where('slug', $slug)->when($ignore, fn ($query) => $query->where('id', '!=', $ignore))->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }

    private function storeImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        return $request->file('image')->store('products', 'public');
    }

    private function deleteStoredImage(?string $image): void
    {
        if ($image && ! str_starts_with($image, 'images/') && ! str_starts_with($image, 'brand/')) {
            Storage::disk('public')->delete($image);
        }
    }
}
