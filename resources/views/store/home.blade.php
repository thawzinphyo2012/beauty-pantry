@extends('layouts.store')

@section('title', __('store.home.title'))

@section('content')
    <section class="hero-stage">
        <div class="hero-stage__media" aria-hidden="true">
            <img src="{{ asset('images/editorial/ritual.jpg') }}" alt="" data-parallax="22">
        </div>
        <div class="hero-stage__veil" aria-hidden="true"></div>
        <div class="hero-stage__content mx-auto max-w-7xl px-4 pb-16 pt-28 sm:px-6 sm:pb-20 sm:pt-36 lg:px-8 lg:pb-28 lg:pt-44">
            <div class="max-w-3xl is-visible" data-reveal>
                <img src="{{ asset('brand/logo-secondary-light.png') }}" alt="Beauty Pantry" class="anim-rise h-12 w-auto drop-shadow-sm sm:h-16 lg:h-24" style="--rise-delay: 40ms">
                <p class="anim-rise eyebrow mt-6 text-mint sm:mt-8" style="--rise-delay: 140ms">{{ __('store.home.eyebrow') }}</p>
                <h1 class="text-3d text-3d--light mt-4 font-display text-[clamp(2.6rem,10vw,7.2rem)] leading-[0.92] tracking-[-0.03em] sm:mt-5" data-text-3d style="--text-delay: 220ms">
                    @if (__('store.home.headline_before') !== '')
                        {{ __('store.home.headline_before') }}
                    @endif
                    <em class="font-medium text-mint">{{ __('store.home.headline_em') }}</em>
                    {{ __('store.home.headline_after') }}
                </h1>
                <p class="anim-rise mt-5 max-w-md text-base leading-7 text-ivory/80 sm:mt-6 sm:text-lg" style="--rise-delay: 900ms">{{ __('store.home.lead') }}</p>
                <div class="anim-rise mt-8 flex w-full flex-col gap-3 sm:mt-10 sm:flex-row sm:items-center" style="--rise-delay: 1040ms">
                    <a href="{{ route('shop') }}" class="btn btn-mint btn-shine">{{ __('store.home.cta_shop') }}</a>
                    <a href="{{ route('about') }}" class="btn btn-line btn-shine">{{ __('store.home.cta_story') }}</a>
                </div>
            </div>
        </div>
        <div class="hero-scroll" aria-hidden="true">
            <span></span>
        </div>
    </section>

    <div class="marquee" aria-hidden="true">
        <div class="marquee-track">
            @foreach (range(1, 2) as $copy)
                @foreach (__('store.home.marquee') as $item)
                    <span>{{ $item }}</span><span>·</span>
                @endforeach
            @endforeach
        </div>
    </div>

    <section class="section-screen mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8 lg:py-28">
        <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end" data-reveal>
            <div class="min-w-0">
                <p class="anim-rise eyebrow text-mint-deep" style="--rise-delay: 40ms">{{ __('store.home.collections') }}</p>
                <h2 class="text-3d section-title mt-3 font-display text-[clamp(2.4rem,7vw,3.75rem)] leading-[0.95] sm:text-5xl lg:text-6xl" data-text-3d style="--text-delay: 100ms">
                    {{ __('store.home.collections_title') }}
                </h2>
            </div>
            <a href="{{ route('shop') }}" class="anim-rise btn btn-ghost btn-shine w-full sm:w-auto" style="--rise-delay: 420ms">{{ __('store.home.view_all') }}</a>
        </div>
        <div class="collection-grid mt-10 grid gap-3 sm:mt-12 sm:gap-4 sm:grid-cols-2 lg:grid-cols-3" data-spotlight data-cascade data-cascade-step="100" data-cascade-start="60">
            @foreach ($categories as $category)
                <a
                    href="{{ route('shop', ['category' => $category->slug]) }}"
                    class="collection-tile group"
                    data-reveal="bloom"
                    style="--reveal-delay: {{ $loop->index * 90 }}ms"
                >
                    <span class="collection-tile__media" aria-hidden="true">
                        <img src="{{ $category->image_url }}" alt="" loading="lazy">
                    </span>
                    <span class="collection-tile__veil" aria-hidden="true"></span>
                    <span class="collection-tile__body">
                        <span class="collection-tile__top">
                            <span class="tile-index eyebrow">0{{ $category->sort }}</span>
                            <span class="tile-meta max-w-[50%] truncate text-sm">{{ $category->eyebrow }}</span>
                        </span>
                        <span class="collection-tile__copy">
                            <h3 class="font-display text-3xl sm:text-4xl">{{ $category->name }}</h3>
                            <p class="tile-copy mt-2 max-w-xs text-sm leading-6 line-clamp-3">{{ $category->description }}</p>
                        </span>
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    <section class="section-screen wave-stage mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
        @include('partials.wave-sea')
        <div class="relative z-[1] mb-8 sm:mb-10" data-reveal>
            <p class="anim-rise eyebrow text-mint-deep" style="--rise-delay: 40ms">{{ __('store.home.the_edit') }}</p>
            <h2 class="text-3d section-title mt-3 font-display text-[clamp(2.4rem,7vw,3.75rem)] leading-[0.95] sm:text-5xl lg:text-6xl" data-text-3d style="--text-delay: 100ms">
                {{ __('store.home.edit_title') }}
            </h2>
        </div>
        <div class="relative z-[1] grid gap-x-4 gap-y-10 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-4" data-spotlight data-cascade data-cascade-step="100" data-cascade-start="80">
            @foreach ($featured as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    <section class="cinema-split mx-auto mt-16 grid max-w-7xl items-stretch gap-0 overflow-hidden rounded-[1.5rem] sm:mx-6 sm:mt-24 sm:rounded-[2rem] md:grid-cols-2 lg:mx-8">
        <div class="media-frame cinema-split__media overflow-hidden" data-reveal="left">
            <img src="{{ asset('images/editorial/hero.jpg') }}" alt="A botanical serum still life" class="h-full min-h-[18rem] w-full object-cover sm:min-h-[22rem] lg:min-h-[28rem]" loading="lazy">
        </div>
        <div class="cinema-split__copy flex flex-col justify-center px-5 py-10 sm:px-10 sm:py-12 lg:px-12" data-reveal="right">
            <p class="anim-rise eyebrow text-mint" style="--rise-delay: 60ms">{{ __('store.home.house_notes') }}</p>
            <h2 class="text-3d text-3d--light section-title mt-4 font-display text-[clamp(2.2rem,6vw,3.5rem)] leading-[0.95] text-ivory sm:text-5xl lg:text-6xl" data-text-3d style="--text-delay: 120ms">
                {{ __('store.home.house_title') }}
            </h2>
            <p class="anim-rise mt-6 max-w-md text-base leading-8 text-ivory/70" style="--rise-delay: 520ms">{{ __('store.home.house_copy') }}</p>
            <a href="{{ route('about') }}" class="anim-rise btn btn-mint btn-shine mt-8 w-full sm:w-fit" style="--rise-delay: 640ms">{{ __('store.home.read_atelier') }}</a>
        </div>
    </section>

    <section class="section-screen wave-stage mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
        @include('partials.wave-sea')
        <div class="relative z-[1] mb-8 sm:mb-10" data-reveal>
            <p class="anim-rise eyebrow text-mint-deep" style="--rise-delay: 40ms">{{ __('store.home.most_loved') }}</p>
            <h2 class="text-3d section-title mt-3 font-display text-[clamp(2.4rem,7vw,3.75rem)] leading-[0.95] sm:text-5xl lg:text-6xl" data-text-3d style="--text-delay: 100ms">
                {{ __('store.home.loved_title') }}
            </h2>
        </div>
        <div class="relative z-[1] grid gap-x-4 gap-y-10 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-4" data-spotlight data-cascade data-cascade-step="100" data-cascade-start="80">
            @foreach ($bestsellers as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    <section class="ritual-band">
        <div class="mx-auto grid max-w-7xl gap-4 px-4 py-14 sm:gap-5 sm:px-6 sm:py-20 md:grid-cols-2 lg:grid-cols-3 lg:gap-6 lg:px-8" data-cascade data-cascade-step="120" data-cascade-start="40">
            @foreach ([
                ['01', __('store.home.ritual_cleanse'), __('store.home.ritual_cleanse_copy'), 'cleanse.jpg'],
                ['02', __('store.home.ritual_treat'), __('store.home.ritual_treat_copy'), 'treat.jpg'],
                ['03', __('store.home.ritual_seal'), __('store.home.ritual_seal_copy'), 'seal.jpg'],
            ] as $index => [$step, $title, $copy, $image])
                <article class="ritual-photo {{ $index === 2 ? 'md:col-span-2 lg:col-span-1' : '' }}" data-reveal style="--reveal-delay: {{ $index * 120 }}ms">
                    <span class="ritual-photo__media" aria-hidden="true">
                        <img src="{{ asset('images/ritual/'.$image) }}" alt="" loading="lazy">
                    </span>
                    <span class="ritual-photo__veil" aria-hidden="true"></span>
                    <span class="ritual-photo__body">
                        <p class="eyebrow ritual-photo__step">{{ $step }}</p>
                        <div>
                            <h3 class="font-display text-3xl sm:text-4xl">{{ $title }}</h3>
                            <p class="mt-3 max-w-xs text-sm leading-7">{{ $copy }}</p>
                        </div>
                    </span>
                </article>
            @endforeach
        </div>
    </section>

    <section class="quote-band night-panel mx-3 my-12 overflow-hidden rounded-[1.5rem] sm:mx-6 sm:my-16 sm:rounded-[2rem] lg:mx-8">
        <div class="mx-auto grid max-w-7xl items-center gap-8 px-5 py-12 sm:gap-8 sm:px-10 sm:py-16 md:grid-cols-2 lg:gap-12 lg:py-20">
            <blockquote class="pl-2 sm:pl-4" data-reveal="left">
                <p class="text-3d text-3d--light font-display text-[clamp(1.85rem,6vw,2.75rem)] leading-[1.1] text-ivory sm:text-4xl lg:text-5xl" data-text-3d style="--text-delay: 80ms">
                    {{ __('store.home.quote') }}
                </p>
                <footer class="anim-rise mt-6 text-sm tracking-[0.12em] text-mint uppercase sm:tracking-[0.16em]" style="--rise-delay: 720ms">{{ __('store.home.quote_by') }}</footer>
            </blockquote>
            <div class="media-frame overflow-hidden rounded-[1.2rem] sm:rounded-[1.4rem]" data-reveal="right">
                <img src="{{ asset('images/editorial/hands.jpg') }}" alt="A quiet facial ritual" class="aspect-[4/3] w-full object-cover" loading="lazy">
            </div>
        </div>
    </section>
@endsection
