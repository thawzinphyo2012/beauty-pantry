@extends('layouts.store')

@section('title', $product->name.' — Beauty Pantry')

@section('content')
    <section class="product-stage">
        <div class="product-stage__glow" aria-hidden="true"></div>
        <article class="relative mx-auto grid max-w-7xl gap-10 px-4 pb-20 pt-8 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8 lg:pt-12">
            <div class="product-visual lg:sticky lg:top-28 lg:self-start" data-reveal="left">
                <div class="media-frame product-visual__frame overflow-hidden rounded-[1.8rem]">
                    <span class="product-visual__solid" aria-hidden="true"></span>
                    <span class="product-visual__aura" aria-hidden="true"></span>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-visual__image aspect-[4/5] w-full object-cover">
                </div>
            </div>

            <div class="product-copy is-visible" data-reveal>
                <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="anim-rise eyebrow text-mint-deep transition hover:text-mint" style="--rise-delay: 60ms">{{ $product->category->name }}</a>

                <h1 class="page-title text-3d mt-3 font-display leading-[0.95]" data-text-3d style="--text-delay: 120ms">
                    {{ $product->name }}
                </h1>

                <p class="anim-rise mt-4 text-lg text-charcoal" style="--rise-delay: 420ms">{{ $product->subtitle }}</p>

                <div class="anim-rise mt-6 flex flex-wrap items-baseline gap-3" style="--rise-delay: 520ms">
                    <p class="text-xl">@money($product->price)</p>
                    @if ($product->compare_price)
                        <p class="text-sm text-charcoal line-through">@money($product->compare_price)</p>
                    @endif
                    @if ($product->badge)
                        <span class="product-badge rounded-full bg-mist px-3 py-1 text-[0.65rem] tracking-[0.16em] uppercase">{{ $product->badge }}</span>
                    @endif
                </div>

                <p class="anim-rise mt-6 max-w-xl text-base leading-8" style="--rise-delay: 620ms">{{ $product->description }}</p>

                <form action="{{ route('cart.store') }}" method="POST" class="anim-rise mt-8 flex flex-col gap-3 sm:flex-row sm:items-center" style="--rise-delay: 740ms">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <label class="sr-only" for="quantity">{{ __('store.product.quantity') }}</label>
                    <input id="quantity" name="quantity" type="number" min="1" max="{{ max(1, min(8, $product->stock)) }}" value="1" class="field w-full sm:w-28" {{ $product->inStock() ? '' : 'disabled' }}>
                    <button class="btn btn-bag btn-shine w-full sm:w-auto" type="submit" {{ $product->inStock() ? '' : 'disabled' }}>
                        {{ $product->inStock() ? __('store.product.add') : __('store.product.out') }}
                    </button>
                </form>

                <p class="anim-rise mt-3 text-sm text-charcoal" style="--rise-delay: 840ms">{{ __('store.product.stock', ['count' => $product->stock]) }} @if($product->sku) · {{ $product->sku }} @endif</p>

                <div class="anim-rise mt-10 divide-y divide-line border-y border-line" style="--rise-delay: 920ms">
                    @foreach ([__('store.product.story') => $product->story, __('store.product.ingredients') => $product->ingredients, __('store.product.how_to') => $product->how_to] as $label => $copy)
                        @if ($copy)
                            <details class="product-accordion group py-4" {{ $loop->first ? 'open' : '' }} data-accordion>
                                <summary class="product-accordion__summary flex cursor-pointer list-none items-center justify-between gap-3 font-display text-xl sm:text-2xl">
                                    <span class="product-accordion__label min-w-0 break-words">{{ $label }}</span>
                                    <span class="product-accordion__icon inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-line text-mint-deep" aria-hidden="true">+</span>
                                </summary>
                                <div class="accordion-panel">
                                    <div class="accordion-panel__inner">
                                        <p class="mt-3 max-w-xl text-sm leading-7 text-charcoal">{{ $copy }}</p>
                                    </div>
                                </div>
                            </details>
                        @endif
                    @endforeach
                </div>

                <p class="anim-rise mt-6 text-sm leading-7 text-charcoal" style="--rise-delay: 1000ms">{{ __('store.product.shipping') }}</p>
            </div>
        </article>
    </section>

    @if ($related->isNotEmpty())
        <section class="section-screen relative mx-auto max-w-7xl px-4 pb-10 sm:px-6 lg:px-8">
            <h2 class="text-3d font-display text-4xl sm:text-5xl" data-reveal data-text-3d style="--text-delay: 80ms">
                {{ __('store.product.also_in', ['name' => $product->category->name]) }}
            </h2>
            <div class="mt-8 grid gap-x-4 gap-y-10 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-4" data-spotlight data-cascade data-cascade-step="100" data-cascade-start="60">
                @foreach ($related as $item)
                    <x-product-card :product="$item" />
                @endforeach
            </div>
        </section>
    @endif
@endsection
