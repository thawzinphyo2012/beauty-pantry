@extends('layouts.admin')

@section('title', $order->number)

@section('content')
    <p class="eyebrow text-mint-deep">{{ $order->created_at->format('d M Y, H:i') }}</p>
    <h1 class="mt-2 font-display text-5xl">{{ $order->number }}</h1>
    <div class="mt-8 grid gap-8 lg:grid-cols-[minmax(0,1fr)_20rem]">
        <div class="overflow-x-auto rounded-[1.4rem] border border-line">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-paper text-xs tracking-[0.14em] text-charcoal uppercase">
                    <tr>
                        <th class="px-4 py-3 font-medium">Item</th>
                        <th class="px-4 py-3 font-medium">Qty</th>
                        <th class="px-4 py-3 font-medium">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-t border-line">
                            <td class="px-4 py-3">{{ $item->name }}</td>
                            <td class="px-4 py-3">{{ $item->quantity }}</td>
                            <td class="px-4 py-3">@money($item->price * $item->quantity)</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <aside class="space-y-6">
            <div class="rounded-[1.4rem] border border-line bg-paper p-5 text-sm leading-7">
                <p class="font-medium">{{ $order->customer_name }}</p>
                <p>{{ $order->email }}</p>
                <p>{{ $order->phone }}</p>
                <p class="mt-2">{{ $order->address }}, {{ $order->city }}</p>
                @if ($order->notes)<p class="mt-2 text-charcoal">{{ $order->notes }}</p>@endif
                <p class="mt-4">Delivery @money($order->shipping) · Total @money($order->total)</p>
            </div>
            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="grid gap-3">
                @csrf
                @method('PATCH')
                <label class="eyebrow text-charcoal" for="status">Status</label>
                <select id="status" name="status" class="field">
                    @foreach (\App\Models\Order::STATUSES as $status)
                        <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <button class="btn btn-ink">Update status</button>
            </form>
        </aside>
    </div>
@endsection
