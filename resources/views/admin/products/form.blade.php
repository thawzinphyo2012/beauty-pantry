@extends('layouts.admin')

@section('title', $product->exists ? 'Edit product' : 'New product')

@section('content')
    <p class="eyebrow text-mint-deep">Catalog</p>
    <h1 class="mt-2 font-display text-5xl">{{ $product->exists ? 'Edit '.$product->name : 'New product' }}</h1>
    <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="mt-8 grid max-w-3xl gap-4">
        @csrf
        @if ($product->exists) @method('PUT') @endif
        <div>
            <label class="eyebrow text-charcoal" for="name">Name</label>
            <input id="name" name="name" value="{{ old('name', $product->name) }}" class="field mt-2" required>
            @error('name')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="eyebrow text-charcoal" for="category_id">Collection</label>
                <select id="category_id" name="category_id" class="field mt-2" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) old('category_id', $product->category_id) === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="eyebrow text-charcoal" for="sku">SKU</label>
                <input id="sku" name="sku" value="{{ old('sku', $product->sku) }}" class="field mt-2">
                @error('sku')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>
        </div>
        <div>
            <label class="eyebrow text-charcoal" for="subtitle">Subtitle</label>
            <input id="subtitle" name="subtitle" value="{{ old('subtitle', $product->subtitle) }}" class="field mt-2">
        </div>
        <div>
            <label class="eyebrow text-charcoal" for="description">Description</label>
            <textarea id="description" name="description" class="field mt-2" required>{{ old('description', $product->description) }}</textarea>
            @error('description')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="eyebrow text-charcoal" for="story">Story</label>
            <textarea id="story" name="story" class="field mt-2">{{ old('story', $product->story) }}</textarea>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="eyebrow text-charcoal" for="ingredients">Ingredients</label>
                <textarea id="ingredients" name="ingredients" class="field mt-2">{{ old('ingredients', $product->ingredients) }}</textarea>
            </div>
            <div>
                <label class="eyebrow text-charcoal" for="how_to">How to use</label>
                <textarea id="how_to" name="how_to" class="field mt-2">{{ old('how_to', $product->how_to) }}</textarea>
            </div>
        </div>
        <div class="grid gap-4 sm:grid-cols-3">
            <div>
                <label class="eyebrow text-charcoal" for="price">Price (MMK)</label>
                <input id="price" type="number" name="price" value="{{ old('price', $product->price) }}" class="field mt-2" required>
            </div>
            <div>
                <label class="eyebrow text-charcoal" for="compare_price">Compare</label>
                <input id="compare_price" type="number" name="compare_price" value="{{ old('compare_price', $product->compare_price) }}" class="field mt-2">
            </div>
            <div>
                <label class="eyebrow text-charcoal" for="stock">Stock</label>
                <input id="stock" type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="field mt-2" required>
            </div>
        </div>
        <div>
            <label class="eyebrow text-charcoal" for="badge">Badge</label>
            <input id="badge" name="badge" value="{{ old('badge', $product->badge) }}" class="field mt-2" placeholder="Bestseller">
        </div>
        <div>
            <label class="eyebrow text-charcoal" for="image">Image</label>
            <input id="image" type="file" name="image" accept="image/*" class="mt-2 block w-full text-sm">
            @error('image')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            @if ($product->image)
                <img src="{{ $product->image_url }}" alt="" class="mt-3 h-28 rounded-2xl object-cover">
            @endif
        </div>
        <div class="flex flex-wrap gap-6 text-sm">
            <label class="flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured)) class="accent-mint"> Featured</label>
            <label class="flex items-center gap-2"><input type="checkbox" name="is_bestseller" value="1" @checked(old('is_bestseller', $product->is_bestseller)) class="accent-mint"> Bestseller</label>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <button class="btn btn-ink">Save product</button>
            @if ($product->exists)
                <a href="{{ route('product.show', $product) }}" class="btn btn-ghost">View</a>
            @endif
        </div>
    </form>
    @if ($product->exists)
        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="mt-6" onsubmit="return confirm('Remove this product?')">
            @csrf
            @method('DELETE')
            <button class="text-sm text-red-700 underline underline-offset-4">Delete product</button>
        </form>
    @endif
@endsection
