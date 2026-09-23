@extends('layouts.admin')

@section('title', 'Clients')

@section('content')
    <p class="eyebrow text-mint-deep">House</p>
    <h1 class="mt-2 font-display text-5xl">Clients</h1>
    <div class="mt-8 overflow-x-auto rounded-[1.4rem] border border-line">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-paper text-xs tracking-[0.14em] text-charcoal uppercase">
                <tr>
                    <th class="px-4 py-3 font-medium">Name</th>
                    <th class="px-4 py-3 font-medium">Email</th>
                    <th class="px-4 py-3 font-medium">Orders</th>
                    <th class="px-4 py-3 font-medium">Joined</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3">{{ $customer->name }}</td>
                        <td class="px-4 py-3">{{ $customer->email }}</td>
                        <td class="px-4 py-3">{{ $customer->orders_count }}</td>
                        <td class="px-4 py-3">{{ $customer->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-8 text-charcoal">No client accounts yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $customers->links() }}</div>
@endsection
