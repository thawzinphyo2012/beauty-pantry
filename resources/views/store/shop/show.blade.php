@extends('layouts.store')

@section('title', $product->name.' — Beauty Pantry')

@section('content')
    <article class="mx-auto grid max-w-7xl gap-10 px-4 pb-20 pt-8 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8 lg:pt-12">
        <div class="lg:sticky lg:top-28 lg:self-start">
            <div class="overflow-hidden rounded-[1.8rem] bg-paper">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="aspect-[4/5] w-full object-cover">
            </div>
        </div>
        <div>
            <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="eyebrow text-mint-deep">{{ $product->category->name }}</a>
            <h1 class="mt-3 font-display text-5xl leading-[0.95] sm:text-7xl">{{ $product->name }}</h1>
            <p class="mt-4 text-lg text-charcoal">{{ $product->subtitle }}</p>
            <div class="mt-6 flex items-baseline gap-3">
                <p class="text-xl">@money($product->price)</p>
                @if ($product->compare_price)
                    <p class="text-sm text-charcoal line-through">@money($product->compare_price)</p>
                @endif
                @if ($product->badge)
                    <span class="rounded-full bg-mist px-3 py-1 text-[0.65rem] tracking-[0.16em] uppercase">{{ $product->badge }}</span>
                @endif
            </div>
            <p class="mt-6 max-w-xl text-base leading-8">{{ $product->description }}</p>

            <form action="{{ route('cart.store') }}" method="POST" class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <label class="sr-only" for="quantity">Quantity</label>
                <input id="quantity" name="quantity" type="number" min="1" max="{{ max(1, min(8, $product->stock)) }}" value="1" class="field w-full sm:w-28" {{ $product->inStock() ? '' : 'disabled' }}>
                <button class="btn btn-ink w-full sm:w-auto" {{ $product->inStock() ? '' : 'disabled' }}>
                    {{ $product->inStock() ? 'Add to bag' : 'Out of stock' }}
                </button>
            </form>
            <p class="mt-3 text-sm text-charcoal">{{ $product->stock }} in the atelier @if($product->sku) · {{ $product->sku }} @endif</p>

            <div class="mt-10 divide-y divide-line border-y border-line">
                @foreach (['Story' => $product->story, 'Ingredients' => $product->ingredients, 'How to use' => $product->how_to] as $label => $copy)
                    @if ($copy)
                        <details class="group py-4" {{ $loop->first ? 'open' : '' }}>
                            <summary class="flex cursor-pointer list-none items-center justify-between font-display text-2xl">
                                {{ $label }}
                                <span class="text-mint-deep transition group-open:rotate-45">+</span>
                            </summary>
                            <p class="mt-3 max-w-xl text-sm leading-7 text-charcoal">{{ $copy }}</p>
                        </details>
                    @endif
                @endforeach
            </div>
            <p class="mt-6 text-sm leading-7 text-charcoal">Complimentary delivery in Yangon on orders from Ks 150,000. A Ks 5,000 fee applies below that.</p>
        </div>
    </article>

    @if ($related->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 pb-10 sm:px-6 lg:px-8">
            <h2 class="font-display text-4xl sm:text-5xl">Also in {{ $product->category->name }}</h2>
            <div class="mt-8 grid gap-x-6 gap-y-12 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($related as $item)
                    <x-product-card :product="$item" />
                @endforeach
            </div>
        </section>
    @endif
@endsection
