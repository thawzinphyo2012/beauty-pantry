@extends('layouts.admin')

@section('title', 'Collections')

@section('content')
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="eyebrow text-mint-deep">Catalog</p>
            <h1 class="mt-2 font-display text-5xl">Collections</h1>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-ink">Add collection</a>
    </div>
    <div class="mt-8 overflow-x-auto rounded-[1.4rem] border border-line">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-paper text-xs tracking-[0.14em] text-charcoal uppercase">
                <tr>
                    <th class="px-4 py-3 font-medium">Name</th>
                    <th class="px-4 py-3 font-medium">Products</th>
                    <th class="px-4 py-3 font-medium">Order</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3">{{ $category->name }}</td>
                        <td class="px-4 py-3">{{ $category->products_count }}</td>
                        <td class="px-4 py-3">{{ $category->sort }}</td>
                        <td class="px-4 py-3 text-right"><a href="{{ route('admin.categories.edit', $category) }}" class="underline underline-offset-4">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
