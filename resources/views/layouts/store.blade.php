<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Beauty Pantry — a luxury cosmetics house for quiet radiance. Skincare, makeup, fragrance, and atelier gifts.">
    <title>@yield('title', 'Beauty Pantry')</title>
    <link rel="icon" href="{{ asset('brand/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased {{ request()->routeIs('home') ? 'has-overlay-header' : '' }}">
    <div class="bg-pantry" aria-hidden="true">
        <span class="bg-pantry__base"></span>
        <span class="bg-pantry__blinds"></span>
        <span class="bg-pantry__glow bg-pantry__glow--tl"></span>
        <span class="bg-pantry__glow bg-pantry__glow--br"></span>
        <span class="bg-pantry__glow bg-pantry__glow--c"></span>
        <span class="bg-pantry__ripple bg-pantry__ripple--a"></span>
        <span class="bg-pantry__ripple bg-pantry__ripple--b"></span>
        <span class="bg-pantry__ripple bg-pantry__ripple--c"></span>
        <span class="bg-pantry__shelf"></span>
        <span class="bg-pantry__petal bg-pantry__petal--a"></span>
        <span class="bg-pantry__petal bg-pantry__petal--b"></span>
        <span class="bg-pantry__petal bg-pantry__petal--c"></span>
        <span class="bg-pantry__petal bg-pantry__petal--d"></span>
        <span class="bg-pantry__spark">
            @foreach (range(1, 12) as $i)
                <i style="--i: {{ $i }}"></i>
            @endforeach
        </span>
        <span class="bg-pantry__veil"></span>
    </div>

    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:bg-ivory focus:px-4 focus:py-2">Skip to content</a>

    <div class="scroll-progress" aria-hidden="true"><span data-scroll-progress></span></div>
    <div class="cursor-glow" aria-hidden="true" data-cursor-glow></div>

    @include('partials.header')

    @if (session('status'))
        <div class="flash" role="status">{{ session('status') }}</div>
    @endif

    <main id="main" class="page-shell page-enter">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
