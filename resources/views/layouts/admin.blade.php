<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Beauty Pantry</title>
    <link rel="icon" href="{{ asset('brand/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;1,500&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ivory font-sans text-ink antialiased">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-[17rem_minmax(0,1fr)]">
        <aside class="admin-sidebar night-panel text-ivory lg:sticky lg:top-0 lg:h-screen lg:overflow-y-auto">
            <div class="flex items-center justify-between px-5 py-5 lg:block">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('brand/mark.png') }}" alt="" class="h-10 w-auto">
                    <span>
                        <span class="block font-display text-2xl leading-none">Beauty Pantry</span>
                        <span class="eyebrow text-mint">Atelier desk</span>
                    </span>
                </a>
            </div>
            <nav class="flex gap-2 overflow-x-auto px-4 pb-4 lg:mt-4 lg:block lg:space-y-1 lg:overflow-visible lg:px-3 lg:pb-8" aria-label="Admin">
                @foreach ([
                    ['admin.dashboard', 'Overview', 'admin.dashboard'],
                    ['admin.products.*', 'Products', 'admin.products.index'],
                    ['admin.categories.*', 'Collections', 'admin.categories.index'],
                    ['admin.orders.*', 'Orders', 'admin.orders.index'],
                    ['admin.inquiries.*', 'Notes', 'admin.inquiries.index'],
                    ['admin.customers.*', 'Clients', 'admin.customers.index'],
                ] as [$pattern, $label, $route])
                    <a href="{{ route($route) }}" class="block whitespace-nowrap rounded-full px-4 py-2.5 text-sm {{ request()->routeIs($pattern) ? 'bg-mint text-ink' : 'text-ivory/75 hover:bg-white/5 hover:text-ivory' }}">{{ $label }}</a>
                @endforeach
                <a href="{{ route('home') }}" class="block whitespace-nowrap rounded-full px-4 py-2.5 text-sm text-ivory/75 hover:bg-white/5 hover:text-ivory">View store</a>
                <form action="{{ route('logout') }}" method="POST" class="lg:px-1 lg:pt-4">
                    @csrf
                    <button class="rounded-full px-4 py-2.5 text-left text-sm text-ivory/75 hover:text-ivory">Sign out</button>
                </form>
            </nav>
        </aside>
        <div class="px-4 py-6 sm:px-6 lg:px-10 lg:py-8">
            @if (session('status'))
                <div class="mb-6 rounded-full bg-ink px-4 py-3 text-sm text-ivory">{{ session('status') }}</div>
            @endif
            @yield('content')
        </div>
    </div>
</body>
</html>
