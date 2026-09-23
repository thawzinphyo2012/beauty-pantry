@props(['product'])

<article class="product-card group">
    <a href="{{ route('product.show', $product) }}" class="block">
        <div class="relative aspect-[4/5] overflow-hidden bg-paper">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
            @if ($product->badge)
                <span class="absolute left-4 top-4 rounded-full bg-ivory/90 px-3 py-1 text-[0.65rem] tracking-[0.18em] uppercase text-ink">{{ $product->badge }}</span>
            @endif
        </div>
        <div class="mt-4 flex items-start justify-between gap-4">
            <div>
                <p class="eyebrow text-charcoal">{{ $product->category->name }}</p>
                <h3 class="mt-1 font-display text-3xl leading-none text-ink">{{ $product->name }}</h3>
                <p class="mt-2 text-sm text-charcoal">{{ $product->subtitle }}</p>
            </div>
            <div class="shrink-0 text-right">
                <p class="text-sm">@money($product->price)</p>
                @if ($product->compare_price)
                    <p class="text-xs text-charcoal/70 line-through">@money($product->compare_price)</p>
                @endif
            </div>
        </div>
    </a>
</article>
