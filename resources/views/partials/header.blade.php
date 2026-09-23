@php
    $cartCount = app(\App\Services\Cart::class)->count();
    $links = [
        ['label' => 'Shop', 'route' => 'shop'],
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Contact', 'route' => 'contact'],
    ];
@endphp

<header class="site-header" data-header>
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="shrink-0" aria-label="Beauty Pantry home">
            <img src="{{ asset('brand/logo-secondary-light.png') }}" alt="Beauty Pantry" class="site-logo logo-on-dark">
            <img src="{{ asset('brand/logo-secondary.png') }}" alt="Beauty Pantry" class="site-logo logo-on-light">
        </a>

        <nav class="hidden items-center gap-8 lg:flex" aria-label="Primary">
            @foreach ($links as $link)
                <a href="{{ route($link['route']) }}" class="eyebrow {{ request()->routeIs($link['route']) || ($link['route'] === 'shop' && request()->routeIs('product.show')) ? 'text-mint-deep' : '' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2 sm:gap-4">
            <form action="{{ route('shop') }}" class="hidden md:block">
                <label class="sr-only" for="header-search">Search</label>
                <input id="header-search" name="q" value="{{ request('q') }}" placeholder="Search" class="w-36 rounded-full border border-current/20 bg-transparent px-4 py-2 text-sm placeholder:text-current/50 lg:w-44">
            </form>

            @auth
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('account') }}" class="eyebrow hidden sm:inline">{{ auth()->user()->isAdmin() ? 'Admin' : 'Account' }}</a>
            @else
                <a href="{{ route('login') }}" class="eyebrow hidden sm:inline">Enter</a>
            @endauth

            <a href="{{ route('cart') }}" class="relative inline-flex h-11 items-center rounded-full border border-current/25 px-4 text-[0.72rem] tracking-[0.16em] uppercase">
                Bag
                <span class="ml-2 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-mint px-1 text-[0.68rem] font-semibold tracking-normal text-ink">{{ $cartCount }}</span>
            </a>

            <button type="button" class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-current/60 lg:hidden" data-nav-toggle aria-expanded="false" aria-label="Open menu">
                <span class="sr-only">Menu</span>
                <span class="flex w-4 flex-col gap-1.5">
                    <span class="block h-px bg-current"></span>
                    <span class="block h-px bg-current"></span>
                    <span class="block h-px w-2.5 bg-current"></span>
                </span>
            </button>
        </div>
    </div>
</header>

<div class="mobile-nav fixed inset-0 z-30 flex-col justify-between bg-ivory px-6 pb-10 pt-28 text-ink lg:hidden" data-nav>
    <nav class="flex flex-col gap-6" aria-label="Mobile">
        @foreach ($links as $link)
            <a href="{{ route($link['route']) }}" class="font-display text-5xl leading-none">{{ $link['label'] }}</a>
        @endforeach
        <a href="{{ route('account') }}" class="font-display text-5xl leading-none">Account</a>
    </nav>
    <form action="{{ route('shop') }}" class="mt-10">
        <input name="q" placeholder="Search the pantry" class="field">
    </form>
</div>
