@extends('layouts.store')

@section('title', 'Account — Beauty Pantry')

@section('content')
    <section class="mx-auto max-w-4xl px-4 pb-20 pt-10 sm:px-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="eyebrow text-mint-deep">Account</p>
                <h1 class="mt-3 font-display text-6xl leading-none">{{ auth()->user()->name }}</h1>
                <p class="mt-2 text-charcoal">{{ auth()->user()->email }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-ghost">Sign out</button>
            </form>
        </div>

        <h2 class="mt-12 font-display text-4xl">Orders</h2>
        @if ($orders->isEmpty())
            <p class="mt-4 text-charcoal">No orders yet. The edit is waiting.</p>
            <a href="{{ route('shop') }}" class="btn btn-ink mt-6">Shop</a>
        @else
            <div class="mt-6 space-y-4">
                @foreach ($orders as $order)
                    <a href="{{ route('orders.success', $order) }}" class="block rounded-[1.4rem] border border-line bg-paper p-5 transition hover:border-ink">
                        <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-center">
                            <div>
                                <p class="eyebrow text-charcoal">{{ $order->number }}</p>
                                <p class="mt-1 font-display text-3xl">@money($order->total)</p>
                            </div>
                            <div class="text-sm text-charcoal sm:text-right">
                                <p class="uppercase tracking-[0.16em]">{{ $order->status }}</p>
                                <p class="mt-1">{{ $order->created_at->format('d M Y') }} · {{ $order->items->count() }} items</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection
