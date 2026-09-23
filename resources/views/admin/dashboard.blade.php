@extends('layouts.admin')

@section('title', 'Overview')

@section('content')
    <p class="eyebrow text-mint-deep">Today</p>
    <h1 class="mt-2 font-display text-5xl">Atelier overview</h1>
    <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['Revenue', \App\Support\Money::format($revenue)],
            ['Orders', $orderCount],
            ['Products', $productCount],
            ['Unread notes', $unread],
        ] as [$label, $value])
            <div class="rounded-[1.4rem] border border-line bg-paper p-5">
                <p class="eyebrow text-charcoal">{{ $label }}</p>
                <p class="mt-3 font-display text-4xl">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-10 grid gap-8 xl:grid-cols-5">
        <section class="xl:col-span-3">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="font-display text-3xl">Recent orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-sm underline underline-offset-4">All orders</a>
            </div>
            <div class="overflow-x-auto rounded-[1.4rem] border border-line">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-paper text-xs tracking-[0.14em] text-charcoal uppercase">
                        <tr>
                            <th class="px-4 py-3 font-medium">Order</th>
                            <th class="px-4 py-3 font-medium">Client</th>
                            <th class="px-4 py-3 font-medium">Status</th>
                            <th class="px-4 py-3 font-medium">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentOrders as $order)
                            <tr class="border-t border-line">
                                <td class="px-4 py-3"><a href="{{ route('admin.orders.show', $order) }}" class="underline underline-offset-4">{{ $order->number }}</a></td>
                                <td class="px-4 py-3">{{ $order->customer_name }}</td>
                                <td class="px-4 py-3 capitalize">{{ $order->status }}</td>
                                <td class="px-4 py-3">@money($order->total)</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-4 py-8 text-charcoal">No orders yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
        <section class="xl:col-span-2">
            <h2 class="mb-4 font-display text-3xl">Low stock</h2>
            <div class="space-y-3">
                @forelse ($lowStock as $product)
                    <a href="{{ route('admin.products.edit', $product) }}" class="flex items-center justify-between rounded-2xl border border-line bg-paper px-4 py-3">
                        <span>{{ $product->name }}</span>
                        <span class="rounded-full bg-mist px-3 py-1 text-xs">{{ $product->stock }} left</span>
                    </a>
                @empty
                    <p class="text-sm text-charcoal">Stock is comfortable.</p>
                @endforelse
            </div>
            <p class="mt-6 text-sm text-charcoal">{{ $customerCount }} {{ \Illuminate\Support\Str::plural('client', $customerCount) }}.</p>
        </section>
    </div>
@endsection
