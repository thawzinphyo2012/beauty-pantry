<footer class="night-panel mt-16 text-ivory sm:mt-24">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:gap-12 sm:px-6 sm:py-16 lg:grid-cols-12 lg:px-8 lg:py-20">
        <div class="lg:col-span-5" data-reveal>
            <img src="{{ asset('brand/logo-secondary-light.png') }}" alt="Beauty Pantry" class="h-16 w-auto sm:h-20 lg:h-24">
            <p class="mt-5 max-w-sm text-sm leading-7 text-ivory/70 sm:mt-6">{{ __('store.footer.blurb') }}</p>
        </div>
        <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 lg:col-span-7">
            <div data-reveal style="--reveal-delay: 80ms">
                <p class="eyebrow text-mint">{{ __('store.footer.explore') }}</p>
                <ul class="mt-4 space-y-2 text-sm text-ivory/75">
                    <li><a href="{{ route('shop') }}" class="footer-link hover:text-ivory">{{ __('store.footer.the_edit') }}</a></li>
                    <li><a href="{{ route('shop', ['category' => 'skincare']) }}" class="footer-link hover:text-ivory">{{ __('store.categories.skincare.name') }}</a></li>
                    <li><a href="{{ route('shop', ['category' => 'fragrance']) }}" class="footer-link hover:text-ivory">{{ __('store.categories.fragrance.name') }}</a></li>
                    <li><a href="{{ route('shop', ['category' => 'gifts']) }}" class="footer-link hover:text-ivory">{{ __('store.categories.gifts.name') }}</a></li>
                </ul>
            </div>
            <div data-reveal style="--reveal-delay: 140ms">
                <p class="eyebrow text-mint">{{ __('store.footer.atelier') }}</p>
                <ul class="mt-4 space-y-2 text-sm text-ivory/75">
                    <li><a href="{{ route('about') }}" class="footer-link hover:text-ivory">{{ __('store.footer.our_story') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link hover:text-ivory">{{ __('store.footer.write') }}</a></li>
                    <li><a href="{{ route('account') }}" class="footer-link hover:text-ivory">{{ __('store.footer.orders') }}</a></li>
                    <li><a href="{{ route('login') }}" class="footer-link hover:text-ivory">{{ __('store.footer.account') }}</a></li>
                </ul>
            </div>
            <div class="col-span-2 sm:col-span-1" data-reveal style="--reveal-delay: 200ms">
                <p class="eyebrow text-mint">{{ __('store.footer.care') }}</p>
                <ul class="mt-4 space-y-2 text-sm text-ivory/75">
                    <li>{{ __('store.footer.delivery') }}</li>
                    <li>{{ __('store.footer.fee') }}</li>
                    <li class="break-all">hello@beautypantry.com</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-5 text-center text-[0.65rem] tracking-[0.12em] text-ivory/50 uppercase sm:flex-row sm:items-center sm:justify-between sm:px-6 sm:py-6 sm:text-left sm:text-xs sm:tracking-[0.16em] lg:px-8">
            <p>© {{ date('Y') }} Beauty Pantry</p>
            <p class="hidden sm:block">Mint {{ '#55CF90' }} · Charcoal {{ '#484B4A' }}</p>
        </div>
    </div>
</footer>
