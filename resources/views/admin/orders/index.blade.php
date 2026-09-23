@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="eyebrow text-mint-deep">Desk</p>
            <h1 class="mt-2 font-display text-5xl">Orders</h1>
        </div>
        <form method="GET" class="flex gap-2">
            <select name="status" class="field" onchange="this.form.requestSubmit()">
                <option value="">All statuses</option>
                @foreach (\App\Models\Order::STATUSES as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="mt-8 overflow-x-auto rounded-[1.4rem] border border-line">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-paper text-xs tracking-[0.14em] text-charcoal uppercase">
                <tr>
                    <th class="px-4 py-3 font-medium">Order</th>
                    <th class="px-4 py-3 font-medium">Client</th>
                    <th class="px-4 py-3 font-medium">City</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3"><a class="underline underline-offset-4" href="{{ route('admin.orders.show', $order) }}">{{ $order->number }}</a></td>
                        <td class="px-4 py-3">{{ $order->customer_name }}</td>
                        <td class="px-4 py-3">{{ $order->city }}</td>
                        <td class="px-4 py-3 capitalize">{{ $order->status }}</td>
                        <td class="px-4 py-3">@money($order->total)</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-charcoal">No orders match.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $orders->links() }}</div>
@endsection
