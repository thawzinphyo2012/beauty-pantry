@extends('layouts.store')

@section('title', __('store.about.title'))

@section('content')
    <section class="section-screen mx-auto grid max-w-7xl items-end gap-10 px-4 pb-16 pt-10 sm:px-6 lg:grid-cols-12 lg:px-8">
        <div class="lg:col-span-7 is-visible" data-reveal>
            <p class="anim-rise eyebrow text-mint-deep" style="--rise-delay: 40ms">{{ __('store.about.eyebrow') }}</p>
            <h1 class="text-3d mt-4 font-display text-[clamp(2.6rem,8vw,6.4rem)] leading-[0.9]" data-text-3d style="--text-delay: 100ms">{{ __('store.about.heading') }}</h1>
        </div>
        <p class="anim-rise text-base leading-8 text-charcoal lg:col-span-5" data-reveal style="--reveal-delay: 120ms; --rise-delay: 200ms">{{ __('store.about.lead') }}</p>
    </section>

    <section class="mx-auto grid max-w-7xl gap-4 px-4 sm:gap-6 sm:px-6 md:grid-cols-2 lg:px-8" data-spotlight>
        <div class="media-frame float-3d overflow-hidden rounded-[1.4rem] sm:rounded-[1.8rem]" data-reveal="left" style="animation-delay: 0s">
            <img src="{{ asset('images/editorial/shelf.jpg') }}" alt="A shelf of quiet skincare" class="aspect-[4/5] w-full object-cover" loading="lazy">
        </div>
        <div class="media-frame float-3d overflow-hidden rounded-[1.4rem] md:mt-12 lg:mt-16 sm:rounded-[1.8rem]" data-reveal="right" style="animation-delay: 1.2s">
            <img src="{{ asset('images/editorial/linen.jpg') }}" alt="Soft linen and light" class="aspect-[4/5] w-full object-cover" loading="lazy">
        </div>
    </section>

    <section class="ritual-band mt-12 sm:mt-16">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 py-14 sm:gap-8 sm:px-6 sm:py-20 md:grid-cols-2 lg:grid-cols-3 lg:gap-10 lg:px-8">
            @foreach ([
                [__('store.about.mark'), __('store.about.mark_copy'), 'about/mark.jpg', 'Soft nude color samples'],
                [__('store.about.formulas'), __('store.about.formulas_copy'), 'about/formulas.jpg', 'A short cream formula on skin'],
                [__('store.about.edit'), __('store.about.edit_copy'), 'about/edit.jpg', 'A quiet botanical edit'],
            ] as $index => [$title, $copy, $image, $alt])
                <article class="ritual-step ritual-card {{ $index === 2 ? 'md:col-span-2 lg:col-span-1' : '' }}" data-reveal style="--reveal-delay: {{ $index * 100 }}ms">
                    <div class="ritual-card__media media-frame">
                        <img src="{{ asset('images/'.$image) }}" alt="{{ $alt }}" loading="lazy">
                    </div>
                    <div class="ritual-card__body">
                        <h2 class="font-display text-3xl sm:text-4xl">{{ $title }}</h2>
                        <p class="mt-4 text-sm leading-7 text-charcoal">{{ $copy }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="cinema-split mx-auto mb-8 mt-12 grid max-w-7xl items-stretch gap-0 overflow-hidden rounded-[1.5rem] sm:mx-6 sm:mt-16 sm:rounded-[2rem] md:grid-cols-2 lg:mx-8">
        <div class="cinema-split__copy flex flex-col justify-center px-5 py-10 sm:px-10 sm:py-14 lg:px-12" data-reveal="left">
            <p class="anim-rise eyebrow text-mint" style="--rise-delay: 40ms">{{ __('store.about.visit') }}</p>
            <h2 class="text-3d text-3d--light mt-3 max-w-xl font-display text-[clamp(2rem,6vw,3rem)] leading-none text-ivory sm:text-4xl lg:text-5xl" data-text-3d style="--text-delay: 100ms">{{ __('store.about.visit_title') }}</h2>
            <a href="{{ route('shop') }}" class="anim-rise btn btn-mint btn-shine mt-8 w-full sm:w-fit" style="--rise-delay: 520ms">{{ __('store.about.shop') }}</a>
        </div>
        <div class="media-frame cinema-split__media overflow-hidden" data-reveal="right">
            <img src="{{ asset('images/editorial/ritual.jpg') }}" alt="Quiet ritual still life" class="h-full min-h-[16rem] w-full object-cover sm:min-h-[22rem]" loading="lazy">
        </div>
    </section>
@endsection
