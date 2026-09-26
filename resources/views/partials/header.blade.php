@php
    $cartCount = app(\App\Services\Cart::class)->count();
    $links = [
        ['label' => __('store.nav.shop'), 'route' => 'shop'],
        ['label' => __('store.nav.about'), 'route' => 'about'],
        ['label' => __('store.nav.contact'), 'route' => 'contact'],
    ];
@endphp

<header class="site-header" data-header>
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-2 px-3 py-2.5 sm:gap-4 sm:px-6 sm:py-3 lg:px-8">
        <a href="{{ route('home') }}" class="shrink-0 transition-opacity hover:opacity-80" aria-label="{{ __('store.nav.home') }}">
            <img src="{{ asset('brand/logo-secondary-light.png') }}" alt="Beauty Pantry" class="site-logo logo-on-dark">
            <img src="{{ asset('brand/logo-secondary.png') }}" alt="Beauty Pantry" class="site-logo logo-on-light">
        </a>

        <nav class="hidden items-center gap-6 md:flex lg:gap-8" aria-label="Primary">
            @foreach ($links as $link)
                <a
                    href="{{ route($link['route']) }}"
                    class="nav-link eyebrow {{ request()->routeIs($link['route']) || ($link['route'] === 'shop' && request()->routeIs('product.show')) ? 'is-active text-mint-deep' : '' }}"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-1.5 sm:gap-3">
            <form action="{{ route('shop') }}" class="hidden lg:block">
                <label class="sr-only" for="header-search">{{ __('store.nav.search') }}</label>
                <input id="header-search" name="q" value="{{ request('q') }}" placeholder="{{ __('store.nav.search') }}" class="w-36 rounded-full border border-current/20 bg-transparent px-4 py-2 text-sm transition focus:border-mint focus:outline-none placeholder:text-current/50 lg:w-44">
            </form>

            @auth
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('account') }}" class="eyebrow hidden transition hover:text-mint-deep md:inline">{{ auth()->user()->isAdmin() ? __('store.nav.admin') : __('store.nav.account') }}</a>
            @else
                <a href="{{ route('login') }}" class="eyebrow hidden transition hover:text-mint-deep md:inline">{{ __('store.nav.enter') }}</a>
            @endauth

            <a href="{{ route('cart') }}" class="relative inline-flex h-10 items-center rounded-full border border-current/25 px-3 text-[0.68rem] tracking-[0.14em] uppercase transition hover:border-mint hover:bg-mint/10 sm:h-11 sm:px-4 sm:text-[0.72rem] sm:tracking-[0.16em]">
                <span class="hidden sm:inline">{{ __('store.nav.bag') }}</span>
                <span class="sm:hidden">Bag</span>
                <span class="ml-1.5 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-mint px-1 text-[0.68rem] font-semibold tracking-normal text-ink sm:ml-2">{{ $cartCount }}</span>
            </a>

            <button type="button" class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-current/60 transition hover:border-mint sm:h-11 sm:w-11 md:hidden" data-nav-toggle aria-expanded="false" aria-label="{{ __('store.nav.menu') }}">
                <span class="sr-only">{{ __('store.nav.menu') }}</span>
                <span class="flex w-4 flex-col gap-1.5">
                    <span class="block h-px bg-current"></span>
                    <span class="block h-px bg-current"></span>
                    <span class="block h-px w-2.5 bg-current"></span>
                </span>
            </button>
        </div>
    </div>
</header>

<div class="mobile-nav fixed inset-0 z-30 flex-col justify-between bg-ivory px-5 pb-10 pt-28 text-ink md:hidden" data-nav>
    <nav class="flex flex-col gap-5 sm:gap-6" aria-label="Mobile">
        @foreach ($links as $link)
            <a href="{{ route($link['route']) }}" class="font-display leading-none hover:text-mint-deep">{{ $link['label'] }}</a>
        @endforeach
        <a href="{{ route('account') }}" class="font-display leading-none hover:text-mint-deep">{{ __('store.nav.account') }}</a>
        @guest
            <a href="{{ route('login') }}" class="font-display leading-none hover:text-mint-deep">{{ __('store.nav.enter') }}</a>
        @endguest
    </nav>
    <form action="{{ route('shop') }}" class="mt-8">
        <input name="q" placeholder="{{ __('store.nav.search_pantry') }}" class="field">
    </form>
</div>
