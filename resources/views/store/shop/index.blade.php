@extends('layouts.store')

@section('title', __('store.shop.title'))

@section('content')
    <section class="section-screen wave-stage mx-auto max-w-7xl px-4 pb-16 pt-8 sm:px-6 sm:pb-20 sm:pt-10 lg:px-8">
        @include('partials.wave-sea')
        <div class="relative z-[1] is-visible" data-reveal>
            <p class="anim-rise eyebrow text-mint-deep" style="--rise-delay: 40ms">{{ __('store.shop.eyebrow') }}</p>
            <div class="mt-3 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <h1 class="page-title text-3d font-display leading-none sm:text-6xl lg:text-7xl" data-text-3d style="--text-delay: 80ms">{{ __('store.shop.heading') }}</h1>
                <p class="anim-rise max-w-sm text-sm leading-7 text-charcoal" style="--rise-delay: 420ms">{{ __('store.shop.summary', ['count' => $products->total()]) }}</p>
            </div>
        </div>

        <form method="GET" action="{{ route('shop') }}" class="relative z-[1] shop-toolbar mt-10 flex flex-col gap-4" data-reveal style="--reveal-delay: 80ms">
            @if ($activeCategory)
                <input type="hidden" name="category" value="{{ $activeCategory }}">
            @endif
            <div class="-mx-4 flex gap-2 overflow-x-auto overscroll-x-contain px-4 pb-2 snap-x snap-mandatory sm:mx-0 sm:flex-wrap sm:overflow-visible sm:px-0 sm:pb-1" data-stagger="55">
                <a href="{{ route('shop', array_filter(['q' => request('q'), 'sort' => request('sort')])) }}" class="chip shrink-0 snap-start {{ $activeCategory === '' ? 'is-active' : '' }}">{{ __('store.shop.all') }}</a>
                @foreach ($categories as $category)
                    <a href="{{ route('shop', array_filter(['category' => $category->slug, 'q' => request('q'), 'sort' => request('sort')])) }}" class="chip shrink-0 snap-start {{ $activeCategory === $category->slug ? 'is-active' : '' }}">{{ $category->name }}</a>
                @endforeach
            </div>
            <div class="flex flex-col gap-3 sm:flex-row">
                <input name="q" value="{{ request('q') }}" placeholder="{{ __('store.shop.search') }}" class="field w-full sm:max-w-xs">
                <select name="sort" class="field w-full sm:max-w-[14rem]" onchange="this.form.requestSubmit()">
                    <option value="">{{ __('store.shop.featured') }}</option>
                    <option value="newest" @selected(request('sort') === 'newest')>{{ __('store.shop.newest') }}</option>
                    <option value="price_asc" @selected(request('sort') === 'price_asc')>{{ __('store.shop.price_asc') }}</option>
                    <option value="price_desc" @selected(request('sort') === 'price_desc')>{{ __('store.shop.price_desc') }}</option>
                </select>
                <button class="btn btn-ink btn-shine w-full sm:w-auto" type="submit">{{ __('store.shop.apply') }}</button>
            </div>
        </form>

        @if ($products->isEmpty())
            <div class="relative z-[1] panel panel-glow mt-16 px-6 py-16 text-center" data-reveal>
                <img src="{{ asset('brand/mark.png') }}" alt="" class="mx-auto h-16 w-auto float-3d">
                <h2 class="mt-4 font-display text-4xl" data-text-3d>{{ __('store.shop.empty_title') }}</h2>
                <p class="mt-2 text-charcoal">{{ __('store.shop.empty_copy') }}</p>
                <a href="{{ route('shop') }}" class="btn btn-ink btn-shine mt-6">{{ __('store.shop.reset') }}</a>
            </div>
        @else
            <div
                class="relative z-[1] shop-grid mt-10 grid gap-x-4 gap-y-10 sm:mt-12 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-14 lg:grid-cols-4"
                data-spotlight
                data-cascade
                data-cascade-step="110"
                data-cascade-start="120"
            >
                @foreach ($products as $product)
                    <x-product-card
                        :product="$product"
                        data-reveal="bloom"
                        style="--reveal-delay: {{ $loop->index * 110 }}ms; --cascade-i: {{ $loop->index }}"
                    />
                @endforeach
            </div>
            <div class="relative z-[1] mt-12" data-reveal>{{ $products->links() }}</div>
        @endif
    </section>
@endsection
