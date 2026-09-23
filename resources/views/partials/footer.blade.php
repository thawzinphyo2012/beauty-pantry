<footer class="night-panel mt-24 text-ivory">
    <div class="mx-auto grid max-w-7xl gap-12 px-4 py-16 sm:px-6 lg:grid-cols-12 lg:px-8 lg:py-20">
        <div class="lg:col-span-5">
            <img src="{{ asset('brand/logo-secondary-light.png') }}" alt="Beauty Pantry" class="h-20 w-auto sm:h-24">
            <p class="mt-6 max-w-sm text-sm leading-7 text-ivory/70">A cosmetics house for people who prefer their beauty quiet, botanical, and precisely edited.</p>
        </div>
        <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 lg:col-span-7">
            <div>
                <p class="eyebrow text-mint">Explore</p>
                <ul class="mt-4 space-y-2 text-sm text-ivory/75">
                    <li><a href="{{ route('shop') }}" class="hover:text-ivory">The edit</a></li>
                    <li><a href="{{ route('shop', ['category' => 'skincare']) }}" class="hover:text-ivory">Skincare</a></li>
                    <li><a href="{{ route('shop', ['category' => 'fragrance']) }}" class="hover:text-ivory">Fragrance</a></li>
                    <li><a href="{{ route('shop', ['category' => 'gifts']) }}" class="hover:text-ivory">Gifts</a></li>
                </ul>
            </div>
            <div>
                <p class="eyebrow text-mint">Atelier</p>
                <ul class="mt-4 space-y-2 text-sm text-ivory/75">
                    <li><a href="{{ route('about') }}" class="hover:text-ivory">Our story</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-ivory">Write to us</a></li>
                    <li><a href="{{ route('account') }}" class="hover:text-ivory">Orders</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-ivory">Account</a></li>
                </ul>
            </div>
            <div class="col-span-2 sm:col-span-1">
                <p class="eyebrow text-mint">Care</p>
                <ul class="mt-4 space-y-2 text-sm text-ivory/75">
                    <li>Yangon delivery from Ks 150,000</li>
                    <li>Otherwise Ks 5,000</li>
                    <li>hello@beautypantry.com</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-6 text-xs tracking-[0.16em] text-ivory/50 uppercase sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <p>© {{ date('Y') }} Beauty Pantry</p>
            <p>Mint {{ '#55CF90' }} · Charcoal {{ '#484B4A' }}</p>
        </div>
    </div>
</footer>
