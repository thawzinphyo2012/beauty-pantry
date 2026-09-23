@extends('layouts.store')

@section('title', 'Private — Beauty Pantry')

@section('content')
    <section class="mx-auto max-w-xl px-4 py-24 text-center">
        <h1 class="font-display text-6xl">The atelier desk is private.</h1>
        <p class="mt-3 text-charcoal">This area is reserved for the house admin.</p>
        <a href="{{ route('home') }}" class="btn btn-ink mt-8">Return home</a>
    </section>
@endsection
