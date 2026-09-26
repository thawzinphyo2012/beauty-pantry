@extends('layouts.store')

@section('title', 'Account — Beauty Pantry')

@section('content')
    <section class="section-screen mx-auto max-w-4xl px-4 pb-20 pt-10 sm:px-6">
        <div class="flex flex-col justify-between gap-4 is-visible sm:flex-row sm:items-end" data-reveal>
            <div>
                <p class="anim-rise eyebrow text-mint-deep" style="--rise-delay: 40ms">Account</p>
                <h1 class="page-title text-3d mt-3 font-display leading-none" data-text-3d style="--text-delay: 80ms">{{ auth()->user()->name }}</h1>
                <p class="anim-rise mt-2 text-charcoal" style="--rise-delay: 360ms">{{ auth()->user()->email }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-ghost btn-shine">Sign out</button>
            </form>
        </div>

        <h2 class="text-3d mt-12 font-display text-4xl" data-reveal data-text-3d style="--text-delay: 60ms">Orders</h2>
        @if ($orders->isEmpty())
            <div class="panel panel-glow mt-6 px-6 py-12 text-center" data-reveal style="--reveal-delay: 80ms">
                <p class="text-charcoal">No orders yet. The edit is waiting.</p>
                <a href="{{ route('shop') }}" class="btn btn-ink btn-shine mt-6">Shop</a>
            </div>
        @else
            <div class="mt-6 space-y-4" data-spotlight>
                @foreach ($orders as $order)
                    <a href="{{ route('orders.success', $order) }}" class="panel panel-glow block p-5 transition hover:-translate-y-1 hover:border-ink" data-reveal style="--reveal-delay: {{ $loop->index * 70 }}ms">
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
