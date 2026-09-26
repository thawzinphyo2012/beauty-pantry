@extends('layouts.store')

@section('title', __('store.checkout.title'))

@section('content')
    <section class="section-screen mx-auto grid max-w-7xl items-start gap-10 px-4 pb-16 pt-10 sm:gap-12 sm:px-6 sm:pb-20 lg:grid-cols-[minmax(0,1fr)_22rem] lg:px-8">
        <div class="is-visible" data-reveal="left">
            <p class="anim-rise eyebrow text-mint-deep" style="--rise-delay: 40ms">{{ __('store.checkout.eyebrow') }}</p>
            <h1 class="page-title text-3d mt-3 font-display leading-none" data-text-3d style="--text-delay: 80ms">{{ __('store.checkout.heading') }}</h1>
            <form action="{{ route('checkout.store') }}" method="POST" class="panel panel-glow mt-8 grid gap-4 p-5 sm:mt-10 sm:grid-cols-2 sm:p-8">
                @csrf
                <div class="sm:col-span-2">
                    <label class="eyebrow text-charcoal" for="customer_name">{{ __('store.checkout.name') }}</label>
                    <input id="customer_name" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" class="field mt-2" required>
                    @error('customer_name')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="email">{{ __('store.checkout.email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="field mt-2" required>
                    @error('email')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="phone">{{ __('store.checkout.phone') }}</label>
                    <input id="phone" name="phone" value="{{ old('phone') }}" class="field mt-2" required>
                    @error('phone')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="city">{{ __('store.checkout.city') }}</label>
                    <select id="city" name="city" class="field mt-2" required>
                        @foreach (['Yangon', 'Mandalay', 'Naypyidaw', 'Bago', 'Mawlamyine', 'Taunggyi', 'Other'] as $city)
                            <option value="{{ $city }}" @selected(old('city', 'Yangon') === $city)>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="address">{{ __('store.checkout.address') }}</label>
                    <input id="address" name="address" value="{{ old('address') }}" class="field mt-2" required>
                    @error('address')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="eyebrow text-charcoal" for="notes">{{ __('store.checkout.notes') }}</label>
                    <textarea id="notes" name="notes" class="field mt-2">{{ old('notes') }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <button class="btn btn-ink btn-shine flex w-full flex-col items-center gap-1 sm:w-auto sm:flex-row sm:gap-2">
                        <span>{{ __('store.checkout.place') }}</span>
                        <span class="opacity-80">@money($cart->total())</span>
                    </button>
                </div>
            </form>
        </div>
        <aside class="night-panel rounded-[1.6rem] p-6 text-ivory lg:sticky lg:top-28" data-reveal="right">
            <p class="eyebrow text-mint">{{ __('store.checkout.in_order') }}</p>
            <ul class="mt-5 space-y-4">
                @foreach ($lines as $line)
                    <li class="flex flex-col gap-1 text-sm sm:flex-row sm:items-center sm:justify-between sm:gap-3">
                        <span class="min-w-0 break-words">{{ $line['product']->name }} × {{ $line['quantity'] }}</span>
                        <span class="shrink-0">@money($line['line_total'])</span>
                    </li>
                @endforeach
            </ul>
            <dl class="mt-6 space-y-2 border-t border-white/10 pt-4 text-sm">
                <div class="flex justify-between"><dt class="text-ivory/70">{{ __('store.cart.subtotal') }}</dt><dd>@money($cart->subtotal())</dd></div>
                <div class="flex justify-between"><dt class="text-ivory/70">{{ __('store.cart.delivery') }}</dt><dd>{{ $cart->shipping() === 0 ? __('store.cart.complimentary') : \App\Support\Money::format($cart->shipping()) }}</dd></div>
                <div class="flex justify-between text-base"><dt>{{ __('store.cart.total') }}</dt><dd>@money($cart->total())</dd></div>
            </dl>
        </aside>
    </section>
@endsection
