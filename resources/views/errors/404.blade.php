@extends('layouts.store')

@section('title', 'Not found — Beauty Pantry')

@section('content')
    <section class="mx-auto max-w-xl px-4 py-24 text-center">
        <img src="{{ asset('brand/mark.png') }}" alt="" class="mx-auto h-20 w-auto">
        <h1 class="mt-6 font-display text-6xl">This page left the shelf.</h1>
        <p class="mt-3 text-charcoal">The link may have moved. The pantry is still open.</p>
        <a href="{{ route('home') }}" class="btn btn-ink mt-8">Return home</a>
    </section>
@endsection
