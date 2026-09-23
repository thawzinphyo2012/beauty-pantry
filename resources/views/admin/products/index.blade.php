@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="eyebrow text-mint-deep">Catalog</p>
            <h1 class="mt-2 font-display text-5xl">Products</h1>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-ink">Add product</a>
    </div>
    <div class="mt-8 overflow-x-auto rounded-[1.4rem] border border-line">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-paper text-xs tracking-[0.14em] text-charcoal uppercase">
                <tr>
                    <th class="px-4 py-3 font-medium">Product</th>
                    <th class="px-4 py-3 font-medium">Collection</th>
                    <th class="px-4 py-3 font-medium">Price</th>
                    <th class="px-4 py-3 font-medium">Stock</th>
                    <th class="px-4 py-3 font-medium"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $product->image_url }}" alt="" class="h-12 w-10 rounded-lg object-cover">
                                <span>{{ $product->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">{{ $product->category->name }}</td>
                        <td class="px-4 py-3">@money($product->price)</td>
                        <td class="px-4 py-3">{{ $product->stock }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.products.edit', $product) }}" class="underline underline-offset-4">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $products->links() }}</div>
@endsection
