@props(['product'])

<article {{ $attributes->class(['product-card group'])->merge(['data-reveal' => 'bloom']) }}>
    <a href="{{ route('product.show', $product) }}" class="product-card__link block">
        <div class="media-frame product-card__media relative aspect-[4/5]">
            <span class="product-card__solid" aria-hidden="true"></span>
            <span class="product-card__aura" aria-hidden="true"></span>
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-card__image h-full w-full object-cover" loading="lazy">
            @if ($product->badge)
                <span class="product-card__badge absolute left-4 top-4 rounded-full bg-ivory/90 px-3 py-1 text-[0.65rem] tracking-[0.18em] uppercase text-ink shadow-sm backdrop-blur-sm">{{ $product->badge }}</span>
            @endif
            <span class="product-card__cta pointer-events-none absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                <span class="text-[0.68rem] tracking-[0.2em] text-ivory uppercase">{{ __('store.home.view_formula') }}</span>
            </span>
        </div>
        <div class="product-card__meta mt-4 flex items-start justify-between gap-4">
            <div class="min-w-0">
                <p class="product-card__cat eyebrow text-charcoal">{{ $product->category->name }}</p>
                <h3 class="product-card__title mt-1 font-display text-2xl leading-tight text-ink sm:text-3xl sm:leading-none">{{ $product->name }}</h3>
                <p class="product-card__sub mt-2 line-clamp-2 text-sm text-charcoal">{{ $product->subtitle }}</p>
            </div>
            <div class="product-card__price shrink-0 text-right">
                <p class="text-sm">@money($product->price)</p>
                @if ($product->compare_price)
                    <p class="text-xs text-charcoal/70 line-through">@money($product->compare_price)</p>
                @endif
            </div>
        </div>
    </a>
</article>
