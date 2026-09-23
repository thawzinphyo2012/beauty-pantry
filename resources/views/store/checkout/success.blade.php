@extends('layouts.store')

@section('title', 'Order '.$order->number.' — Beauty Pantry')

@section('content')
    <section class="mx-auto max-w-3xl px-4 pb-24 pt-12 text-center sm:px-6">
        <img src="{{ asset('brand/mark.png') }}" alt="" class="mx-auto h-20 w-auto">
        <p class="eyebrow mt-6 text-mint-deep">Order received</p>
        <h1 class="mt-3 font-display text-6xl leading-none">It is being prepared.</h1>
        <p class="mt-4 text-charcoal">Reference <span class="text-ink">{{ $order->number }}</span>. A note of this order is saved under {{ $order->email }}.</p>
        <div class="mx-auto mt-10 max-w-lg rounded-[1.6rem] border border-line bg-paper p-6 text-left">
            <ul class="space-y-3 text-sm">
                @foreach ($order->items as $item)
                    <li class="flex justify-between gap-4">
                        <span>{{ $item->name }} × {{ $item->quantity }}</span>
                        <span>@money($item->price * $item->quantity)</span>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4 flex justify-between border-t border-line pt-4">
                <span>Total</span>
                <span>@money($order->total)</span>
            </div>
            <p class="mt-4 text-sm leading-6 text-charcoal">{{ $order->customer_name }} · {{ $order->address }}, {{ $order->city }}</p>
        </div>
        <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
            <a href="{{ route('shop') }}" class="btn btn-ink">Continue</a>
            @auth
                <a href="{{ route('account') }}" class="btn btn-ghost">View account</a>
            @endauth
        </div>
    </section>
@endsection
