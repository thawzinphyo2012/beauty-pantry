@extends('layouts.store')

@section('title', 'Your bag — Beauty Pantry')

@section('content')
    <section class="mx-auto max-w-7xl px-4 pb-20 pt-10 sm:px-6 lg:px-8">
        <p class="eyebrow text-mint-deep">Bag</p>
        <h1 class="mt-3 font-display text-6xl leading-none">Your edit.</h1>

        @if ($lines->isEmpty())
            <div class="mt-12 rounded-[1.8rem] border border-line bg-paper px-6 py-16 text-center">
                <img src="{{ asset('brand/mark.png') }}" alt="" class="mx-auto h-20 w-auto">
                <p class="mt-4 font-display text-4xl">The bag is quiet.</p>
                <a href="{{ route('shop') }}" class="btn btn-ink mt-6">Shop the pantry</a>
            </div>
        @else
            <div class="mt-12 grid items-start gap-10 lg:grid-cols-[minmax(0,1fr)_22rem]">
                <div class="space-y-6">
                    @foreach ($lines as $line)
                        @php($product = $line['product'])
                        <div class="grid grid-cols-[6.5rem_minmax(0,1fr)] gap-4 border-b border-line pb-6 sm:grid-cols-[8rem_minmax(0,1fr)_auto]">
                            <a href="{{ route('product.show', $product) }}" class="overflow-hidden rounded-2xl bg-paper">
                                <img src="{{ $product->image_url }}" alt="" class="aspect-square w-full object-cover">
                            </a>
                            <div>
                                <p class="eyebrow text-charcoal">{{ $product->category->name }}</p>
                                <a href="{{ route('product.show', $product) }}" class="mt-1 block font-display text-3xl leading-none">{{ $product->name }}</a>
                                <p class="mt-2 text-sm text-charcoal">@money($product->price)</p>
                                <form action="{{ route('cart.update', $product) }}" method="POST" class="mt-4 flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <label class="sr-only" for="qty-{{ $product->id }}">Quantity</label>
                                    <input id="qty-{{ $product->id }}" type="number" name="quantity" min="0" max="{{ min(8, $product->stock) }}" value="{{ $line['quantity'] }}" class="field w-24">
                                    <button class="btn btn-ghost !min-h-11 !px-4">Update</button>
                                </form>
                            </div>
                            <div class="col-span-2 flex items-center justify-between sm:col-span-1 sm:flex-col sm:items-end">
                                <p class="text-sm">@money($line['line_total'])</p>
                                <form action="{{ route('cart.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="mt-2 text-xs tracking-[0.16em] uppercase text-charcoal underline-offset-4 hover:underline">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <aside class="rounded-[1.6rem] bg-night p-6 text-ivory lg:sticky lg:top-28">
                    <p class="eyebrow text-mint">Summary</p>
                    <dl class="mt-6 space-y-3 text-sm">
                        <div class="flex justify-between"><dt class="text-ivory/70">Subtotal</dt><dd>@money($cart->subtotal())</dd></div>
                        <div class="flex justify-between"><dt class="text-ivory/70">Delivery</dt><dd>{{ $cart->shipping() === 0 ? 'Complimentary' : \App\Support\Money::format($cart->shipping()) }}</dd></div>
                        <div class="flex justify-between border-t border-white/10 pt-3 text-base"><dt>Total</dt><dd>@money($cart->total())</dd></div>
                    </dl>
                    <p class="mt-4 text-xs leading-5 text-ivory/60">
                        @if ($cart->shipping() === 0)
                            Yangon delivery is on the house.
                        @else
                            Add @money(\App\Services\Cart::FREE_SHIPPING_FROM - $cart->subtotal()) for complimentary Yangon delivery.
                        @endif
                    </p>
                    <a href="{{ route('checkout') }}" class="btn btn-mint mt-6 w-full">Checkout</a>
                    <a href="{{ route('shop') }}" class="btn btn-line mt-3 w-full">Continue browsing</a>
                </aside>
            </div>
        @endif
    </section>
@endsection
