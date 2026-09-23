@extends('layouts.store')

@section('title', 'Beauty Pantry — Quiet radiance')

@section('content')
    <section class="night-panel relative flex min-h-[100svh] items-end overflow-hidden text-ivory">
        <div class="mx-auto grid w-full max-w-7xl gap-10 px-4 pb-16 pt-36 sm:px-6 lg:grid-cols-12 lg:items-end lg:px-8 lg:pb-20 lg:pt-40">
            <div class="lg:col-span-7">
                <p class="eyebrow text-mint">Yangon atelier · cosmetics</p>
                <h1 class="mt-5 font-display text-[clamp(3.4rem,8vw,7.4rem)] leading-[0.88] tracking-[-0.03em]">
                    The ritual<br>of <em class="font-medium text-mint">quiet</em><br>radiance.
                </h1>
                <p class="mt-6 max-w-md text-base leading-7 text-ivory/75 sm:text-lg">Beauty Pantry edits skincare, color, and scent for people who want less noise and a more considered finish.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('shop') }}" class="btn btn-mint">Shop the edit</a>
                    <a href="{{ route('about') }}" class="btn btn-line">Our story</a>
                </div>
            </div>
            <div class="relative lg:col-span-5">
                <div class="overflow-hidden rounded-[1.6rem] border border-white/10">
                    <img src="{{ asset('images/editorial/ritual.jpg') }}" alt="A facial ritual at the atelier" class="aspect-[4/5] w-full object-cover sm:aspect-[5/4] lg:aspect-[4/5]">
                </div>
                @if ($spotlight = $featured->first())
                    <a href="{{ route('product.show', $spotlight) }}" class="absolute -left-2 bottom-6 hidden w-56 rounded-3xl border border-white/15 bg-night/80 p-4 backdrop-blur md:block lg:-left-10">
                        <p class="eyebrow text-mint">Now in the pantry</p>
                        <p class="mt-2 font-display text-3xl leading-none">{{ $spotlight->name }}</p>
                        <p class="mt-2 text-sm text-ivory/70">@money($spotlight->price)</p>
                    </a>
                @endif
            </div>
        </div>
    </section>

    <div class="marquee" aria-hidden="true">
        <div class="marquee-track">
            @foreach (range(1, 2) as $copy)
                <span>Clean formulas</span><span>·</span>
                <span>Quiet luxury</span><span>·</span>
                <span>Daily ritual</span><span>·</span>
                <span>Botanical color</span><span>·</span>
                <span>Yangon delivery</span><span>·</span>
                <span>Atelier gifts</span><span>·</span>
            @endforeach
        </div>
    </div>

    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8 lg:py-28">
        <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
            <div>
                <p class="eyebrow text-mint-deep">Collections</p>
                <h2 class="mt-3 font-display text-5xl leading-none sm:text-6xl">Six drawers.<br>Nothing extra.</h2>
            </div>
            <a href="{{ route('shop') }}" class="btn btn-ghost">View all</a>
        </div>
        <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($categories as $category)
                <a href="{{ route('shop', ['category' => $category->slug]) }}" class="group flex min-h-52 flex-col justify-between rounded-[1.6rem] border border-line bg-paper p-6 transition hover:border-ink hover:bg-night hover:text-ivory">
                    <div class="flex items-center justify-between">
                        <span class="eyebrow text-mint-deep group-hover:text-mint">0{{ $category->sort }}</span>
                        <span class="text-sm text-charcoal group-hover:text-ivory/70">{{ $category->eyebrow }}</span>
                    </div>
                    <div>
                        <h3 class="font-display text-4xl">{{ $category->name }}</h3>
                        <p class="mt-2 max-w-xs text-sm leading-6 text-charcoal group-hover:text-ivory/70">{{ $category->description }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
        <div class="mb-10 flex items-end justify-between">
            <div>
                <p class="eyebrow text-mint-deep">The edit</p>
                <h2 class="mt-3 font-display text-5xl leading-none sm:text-6xl">Chosen for the shelf.</h2>
            </div>
        </div>
        <div class="grid gap-x-6 gap-y-12 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($featured as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    <section class="mx-auto mt-20 grid max-w-7xl items-center gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        <div class="overflow-hidden rounded-[1.8rem]">
            <img src="{{ asset('images/editorial/hero.jpg') }}" alt="A botanical serum still life" class="aspect-[4/5] w-full object-cover">
        </div>
        <div class="lg:pl-8">
            <p class="eyebrow text-mint-deep">House notes</p>
            <h2 class="mt-4 font-display text-5xl leading-[0.95] sm:text-6xl">Formulated like a well-set table.</h2>
            <p class="mt-6 max-w-md text-base leading-8 text-charcoal">Every formula is kept short. We would rather you own four things you finish than a cupboard of almosts. The mint mark is our promise of that edit — botanical, calm, and made to be used in the morning light.</p>
            <a href="{{ route('about') }}" class="btn btn-ink mt-8">Read the atelier</a>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8">
        <div class="mb-10">
            <p class="eyebrow text-mint-deep">Most loved</p>
            <h2 class="mt-3 font-display text-5xl leading-none sm:text-6xl">What returns to the bag.</h2>
        </div>
        <div class="grid gap-x-6 gap-y-12 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($bestsellers as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    <section class="bg-paper">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-20 sm:px-6 lg:grid-cols-3 lg:px-8">
            @foreach ([
                ['01', 'Cleanse', 'Jade Rinse lifts the day and leaves the barrier comfortable.'],
                ['02', 'Treat', 'Dew Veil in the morning. Nocturne when the light goes.'],
                ['03', 'Seal', 'Silk Hour, then a thread of scent. The ritual is finished.'],
            ] as [$index, $title, $copy])
                <div class="border-t border-line pt-6">
                    <p class="eyebrow text-mint-deep">{{ $index }}</p>
                    <h3 class="mt-4 font-display text-4xl">{{ $title }}</h3>
                    <p class="mt-3 max-w-xs text-sm leading-7 text-charcoal">{{ $copy }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="night-panel mx-4 my-16 overflow-hidden rounded-[2rem] sm:mx-6 lg:mx-8">
        <div class="mx-auto grid max-w-7xl items-center gap-8 px-6 py-16 sm:px-10 lg:grid-cols-2 lg:py-20">
            <blockquote>
                <p class="font-display text-4xl leading-[1.05] text-ivory sm:text-5xl">“It feels like the cupboard finally has an editor.”</p>
                <footer class="mt-6 text-sm tracking-[0.16em] text-mint uppercase">Hnin Yu · Yangon</footer>
            </blockquote>
            <div class="overflow-hidden rounded-[1.4rem]">
                <img src="{{ asset('images/editorial/hands.jpg') }}" alt="Hands holding a skincare ritual" class="aspect-[4/3] w-full object-cover">
            </div>
        </div>
    </section>
@endsection
