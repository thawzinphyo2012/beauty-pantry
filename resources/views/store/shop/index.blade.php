@extends('layouts.store')

@section('title', 'Shop the edit — Beauty Pantry')

@section('content')
    <section class="mx-auto max-w-7xl px-4 pb-20 pt-10 sm:px-6 lg:px-8">
        <p class="eyebrow text-mint-deep">The pantry</p>
        <div class="mt-3 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <h1 class="font-display text-6xl leading-none sm:text-7xl">Shop</h1>
            <p class="max-w-sm text-sm leading-7 text-charcoal">{{ $products->total() }} formulas, edited by collection. Complimentary Yangon delivery from Ks 150,000.</p>
        </div>

        <form method="GET" action="{{ route('shop') }}" class="mt-10 flex flex-col gap-4">
            @if ($activeCategory)
                <input type="hidden" name="category" value="{{ $activeCategory }}">
            @endif
            <div class="-mx-4 flex gap-2 overflow-x-auto px-4 pb-1 sm:mx-0 sm:flex-wrap sm:px-0">
                <a href="{{ route('shop', array_filter(['q' => request('q'), 'sort' => request('sort')])) }}" class="chip {{ $activeCategory === '' ? 'is-active' : '' }}">All</a>
                @foreach ($categories as $category)
                    <a href="{{ route('shop', array_filter(['category' => $category->slug, 'q' => request('q'), 'sort' => request('sort')])) }}" class="chip {{ $activeCategory === $category->slug ? 'is-active' : '' }}">{{ $category->name }}</a>
                @endforeach
            </div>
            <div class="flex flex-col gap-3 sm:flex-row">
                <input name="q" value="{{ request('q') }}" placeholder="Search formulas" class="field sm:max-w-xs">
                <select name="sort" class="field sm:max-w-[14rem]" onchange="this.form.requestSubmit()">
                    <option value="">Featured</option>
                    <option value="newest" @selected(request('sort') === 'newest')>Newest</option>
                    <option value="price_asc" @selected(request('sort') === 'price_asc')>Price, low to high</option>
                    <option value="price_desc" @selected(request('sort') === 'price_desc')>Price, high to low</option>
                </select>
                <button class="btn btn-ink sm:w-auto" type="submit">Apply</button>
            </div>
        </form>

        @if ($products->isEmpty())
            <div class="mt-16 rounded-[1.6rem] border border-dashed border-line bg-paper px-6 py-16 text-center">
                <img src="{{ asset('brand/mark.png') }}" alt="" class="mx-auto h-16 w-auto">
                <h2 class="mt-4 font-display text-4xl">Nothing in this drawer.</h2>
                <p class="mt-2 text-charcoal">Try another collection, or clear the search.</p>
                <a href="{{ route('shop') }}" class="btn btn-ink mt-6">Reset</a>
            </div>
        @else
            <div class="mt-12 grid gap-x-6 gap-y-14 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
            <div class="mt-12">{{ $products->links() }}</div>
        @endif
    </section>
@endsection
