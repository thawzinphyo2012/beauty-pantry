@extends('layouts.store')

@section('title', 'Checkout — Beauty Pantry')

@section('content')
    <section class="mx-auto grid max-w-7xl items-start gap-12 px-4 pb-20 pt-10 sm:px-6 lg:grid-cols-[minmax(0,1fr)_22rem] lg:px-8">
        <div>
            <p class="eyebrow text-mint-deep">Checkout</p>
            <h1 class="mt-3 font-display text-6xl leading-none">Where shall we send it?</h1>
            <form action="{{ route('checkout.store') }}" method="POST" class="mt-10 grid gap-4 sm:grid-cols-2">
                @csrf
                <div class="sm:col-span-2">
                    <label class="eyebrow text-charcoal" for="customer_name">Name</label>
                    <input id="customer_name" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" class="field mt-2" required>
                    @error('customer_name')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="field mt-2" required>
                    @error('email')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="phone">Phone</label>
                    <input id="phone" name="phone" value="{{ old('phone') }}" class="field mt-2" required>
                    @error('phone')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="city">City</label>
                    <select id="city" name="city" class="field mt-2" required>
                        @foreach (['Yangon', 'Mandalay', 'Naypyidaw', 'Bago', 'Mawlamyine', 'Taunggyi', 'Other'] as $city)
                            <option value="{{ $city }}" @selected(old('city', 'Yangon') === $city)>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="address">Address</label>
                    <input id="address" name="address" value="{{ old('address') }}" class="field mt-2" required>
                    @error('address')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="eyebrow text-charcoal" for="notes">Notes for the courier</label>
                    <textarea id="notes" name="notes" class="field mt-2">{{ old('notes') }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <button class="btn btn-ink w-full sm:w-auto">Place order · @money($cart->total())</button>
                </div>
            </form>
        </div>
        <aside class="rounded-[1.6rem] border border-line bg-paper p-6">
            <p class="eyebrow text-charcoal">In this order</p>
            <ul class="mt-5 space-y-4">
                @foreach ($lines as $line)
                    <li class="flex items-center justify-between gap-3 text-sm">
                        <span>{{ $line['product']->name }} × {{ $line['quantity'] }}</span>
                        <span>@money($line['line_total'])</span>
                    </li>
                @endforeach
            </ul>
            <dl class="mt-6 space-y-2 border-t border-line pt-4 text-sm">
                <div class="flex justify-between"><dt>Subtotal</dt><dd>@money($cart->subtotal())</dd></div>
                <div class="flex justify-between"><dt>Delivery</dt><dd>{{ $cart->shipping() === 0 ? 'Complimentary' : \App\Support\Money::format($cart->shipping()) }}</dd></div>
                <div class="flex justify-between text-base"><dt>Total</dt><dd>@money($cart->total())</dd></div>
            </dl>
        </aside>
    </section>
@endsection
