@extends('layouts.store')

@section('title', 'The atelier — Beauty Pantry')

@section('content')
    <section class="mx-auto grid max-w-7xl items-end gap-10 px-4 pb-16 pt-10 sm:px-6 lg:grid-cols-12 lg:px-8">
        <div class="lg:col-span-7">
            <p class="eyebrow text-mint-deep">The house</p>
            <h1 class="mt-4 font-display text-[clamp(3.2rem,7vw,6.4rem)] leading-[0.9]">Beauty, kept like a pantry.</h1>
        </div>
        <p class="text-base leading-8 text-charcoal lg:col-span-5">Beauty Pantry began as a small edit: fewer bottles, better mornings. The looping mark is a butterfly drawn in a single breath — a reminder that care can be light.</p>
    </section>

    <section class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        <img src="{{ asset('images/editorial/shelf.jpg') }}" alt="A shelf of quiet skincare" class="aspect-[4/5] w-full rounded-[1.8rem] object-cover">
        <img src="{{ asset('images/editorial/linen.jpg') }}" alt="Soft linen and light" class="aspect-[4/5] w-full rounded-[1.8rem] object-cover lg:mt-16">
    </section>

    <section class="mx-auto grid max-w-7xl gap-12 px-4 py-20 sm:px-6 lg:grid-cols-3 lg:px-8">
        @foreach ([
            ['The mark', 'Mint #55CF90 is the only loud color we allow. Charcoal #484B4A carries the name. Everything else is paper, night, and skin.'],
            ['The formulas', 'Short ingredient lists. Textures that suit humid days. Fragrance that stays close instead of arriving first.'],
            ['The edit', 'Six collections. If a product does not earn its place on a small shelf, it does not ship.'],
        ] as [$title, $copy])
            <div>
                <h2 class="font-display text-4xl">{{ $title }}</h2>
                <p class="mt-4 text-sm leading-7 text-charcoal">{{ $copy }}</p>
            </div>
        @endforeach
    </section>
@endsection
