@extends('layouts.store')

@section('title', __('store.cart.title'))

@section('content')
    <section class="section-screen mx-auto max-w-7xl px-4 pb-20 pt-10 sm:px-6 lg:px-8">
        <div class="is-visible" data-reveal>
            <p class="anim-rise eyebrow text-mint-deep" style="--rise-delay: 40ms">{{ __('store.cart.eyebrow') }}</p>
            <h1 class="page-title text-3d mt-3 font-display leading-none" data-text-3d style="--text-delay: 80ms">{{ __('store.cart.heading') }}</h1>
        </div>

        @if ($lines->isEmpty())
            <div class="panel panel-glow mt-12 px-6 py-16 text-center" data-reveal style="--reveal-delay: 80ms">
                <img src="{{ asset('brand/mark.png') }}" alt="" class="mx-auto h-20 w-auto float-3d">
                <p class="mt-4 font-display text-4xl" data-text-3d>{{ __('store.cart.empty') }}</p>
                <a href="{{ route('shop') }}" class="btn btn-ink btn-shine mt-6">{{ __('store.cart.shop') }}</a>
            </div>
        @else
            <div class="mt-12 grid items-start gap-10 lg:grid-cols-[minmax(0,1fr)_22rem]">
                <div class="space-y-6" data-spotlight>
                    @foreach ($lines as $line)
                        @php($product = $line['product'])
                        <div class="cart-line grid grid-cols-[6.5rem_minmax(0,1fr)] gap-4 border-b border-line pb-6 sm:grid-cols-[8rem_minmax(0,1fr)_auto]" data-reveal style="--reveal-delay: {{ $loop->index * 70 }}ms">
                            <a href="{{ route('product.show', $product) }}" class="media-frame overflow-hidden rounded-2xl bg-paper">
                                <img src="{{ $product->image_url }}" alt="" class="aspect-square w-full object-cover">
                            </a>
                            <div>
                                <p class="eyebrow text-charcoal">{{ $product->category->name }}</p>
                                <a href="{{ route('product.show', $product) }}" class="mt-1 block min-w-0 break-words font-display text-2xl leading-tight transition hover:text-mint-deep sm:text-3xl sm:leading-none">{{ $product->name }}</a>
                                <p class="mt-2 text-sm text-charcoal">@money($product->price)</p>
                                <form action="{{ route('cart.update', $product) }}" method="POST" class="mt-4 flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <label class="sr-only" for="qty-{{ $product->id }}">{{ __('store.product.quantity') }}</label>
                                    <input id="qty-{{ $product->id }}" type="number" name="quantity" min="0" max="{{ min(8, $product->stock) }}" value="{{ $line['quantity'] }}" class="field w-24">
                                    <button class="btn btn-ghost !min-h-11 !px-4">{{ __('store.cart.update') }}</button>
                                </form>
                            </div>
                            <div class="col-span-2 flex items-center justify-between sm:col-span-1 sm:flex-col sm:items-end">
                                <p class="text-sm">@money($line['line_total'])</p>
                                <form action="{{ route('cart.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="mt-2 inline-flex min-h-11 items-center px-2 text-xs tracking-[0.16em] uppercase text-charcoal underline-offset-4 transition hover:text-ink hover:underline">{{ __('store.cart.remove') }}</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <aside class="night-panel rounded-[1.6rem] p-6 text-ivory lg:sticky lg:top-28" data-reveal="right">
                    <p class="eyebrow text-mint">{{ __('store.cart.summary') }}</p>
                    <dl class="mt-6 space-y-3 text-sm">
                        <div class="flex justify-between"><dt class="text-ivory/70">{{ __('store.cart.subtotal') }}</dt><dd>@money($cart->subtotal())</dd></div>
                        <div class="flex justify-between"><dt class="text-ivory/70">{{ __('store.cart.delivery') }}</dt><dd>{{ $cart->shipping() === 0 ? __('store.cart.complimentary') : \App\Support\Money::format($cart->shipping()) }}</dd></div>
                        <div class="flex justify-between border-t border-white/10 pt-3 text-base"><dt>{{ __('store.cart.total') }}</dt><dd>@money($cart->total())</dd></div>
                    </dl>
                    <p class="mt-4 text-xs leading-5 text-ivory/60">
                        @if ($cart->shipping() === 0)
                            {{ __('store.cart.free_note') }}
                        @else
                            {{ __('store.cart.add_for_free', ['amount' => \App\Support\Money::format(\App\Services\Cart::FREE_SHIPPING_FROM - $cart->subtotal())]) }}
                        @endif
                    </p>
                    <a href="{{ route('checkout') }}" class="btn btn-mint btn-shine mt-6 w-full">{{ __('store.cart.checkout') }}</a>
                    <a href="{{ route('shop') }}" class="btn btn-line btn-shine mt-3 w-full">{{ __('store.cart.continue') }}</a>
                </aside>
            </div>
        @endif
    </section>
@endsection
