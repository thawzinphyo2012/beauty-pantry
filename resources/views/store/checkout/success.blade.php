@extends('layouts.store')

@section('title', __('store.checkout.success_title', ['number' => $order->number]))

@section('content')
    <section class="success-screen mx-auto max-w-3xl px-4 pb-24 pt-12 text-center sm:px-6">
        <div class="is-visible" data-reveal="scale">
            <div class="success-mark mx-auto">
                <img src="{{ asset('brand/mark.png') }}" alt="" class="mx-auto h-20 w-auto">
            </div>
            <p class="anim-rise eyebrow mt-6 text-mint-deep" style="--rise-delay: 120ms">{{ __('store.checkout.success_eyebrow') }}</p>
            <h1 class="page-title text-3d mt-3 font-display leading-none" data-text-3d style="--text-delay: 180ms">{{ __('store.checkout.success_heading') }}</h1>
            <p class="anim-rise mt-4 text-charcoal" style="--rise-delay: 520ms">{{ __('store.checkout.success_copy', ['number' => $order->number, 'email' => $order->email]) }}</p>
        </div>
        <div class="panel panel-glow mx-auto mt-10 max-w-lg p-6 text-left" data-reveal style="--reveal-delay: 140ms">
            <ul class="space-y-3 text-sm">
                @foreach ($order->items as $item)
                    <li class="flex justify-between gap-4">
                        <span>{{ $item->name }} × {{ $item->quantity }}</span>
                        <span>@money($item->price * $item->quantity)</span>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4 flex justify-between border-t border-line pt-4">
                <span>{{ __('store.cart.total') }}</span>
                <span>@money($order->total)</span>
            </div>
            <p class="mt-4 text-sm leading-6 text-charcoal">{{ $order->customer_name }} · {{ $order->address }}, {{ $order->city }}</p>
        </div>
        <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row" data-reveal style="--reveal-delay: 220ms">
            <a href="{{ route('shop') }}" class="btn btn-ink btn-shine">{{ __('store.checkout.continue') }}</a>
            @auth
                <a href="{{ route('account') }}" class="btn btn-ghost btn-shine">{{ __('store.checkout.view_account') }}</a>
            @endauth
        </div>
    </section>
@endsection
