@extends('layouts.store')

@section('title', __('store.contact.title'))

@section('content')
    <section class="section-screen mx-auto grid max-w-7xl gap-10 px-4 pb-16 pt-8 sm:gap-12 sm:px-6 sm:pb-20 sm:pt-10 lg:grid-cols-2 lg:gap-16 lg:px-8">
        <div class="is-visible" data-reveal="left">
            <p class="anim-rise eyebrow text-mint-deep" style="--rise-delay: 40ms">{{ __('store.contact.eyebrow') }}</p>
            <h1 class="page-title text-3d mt-3 font-display leading-[0.92]" data-text-3d style="--text-delay: 100ms">{{ __('store.contact.heading') }}</h1>
            <p class="anim-rise mt-6 max-w-md text-base leading-8 text-charcoal" style="--rise-delay: 480ms">{{ __('store.contact.lead') }}</p>
            <dl class="mt-10 space-y-5 text-sm">
                <div class="contact-rail anim-rise" style="--rise-delay: 560ms">
                    <dt class="eyebrow text-charcoal">{{ __('store.contact.email') }}</dt>
                    <dd class="mt-1">hello@beautypantry.com</dd>
                </div>
                <div class="contact-rail anim-rise" style="--rise-delay: 640ms">
                    <dt class="eyebrow text-charcoal">{{ __('store.contact.city') }}</dt>
                    <dd class="mt-1">Yangon, Myanmar</dd>
                </div>
                <div class="contact-rail anim-rise" style="--rise-delay: 720ms">
                    <dt class="eyebrow text-charcoal">{{ __('store.contact.hours') }}</dt>
                    <dd class="mt-1">{{ __('store.contact.hours_value') }}</dd>
                </div>
            </dl>
        </div>
        <form action="{{ route('contact.send') }}" method="POST" class="panel panel-glow p-5 sm:p-8" data-reveal="right">
            @csrf
            <div class="grid gap-4" data-stagger="80">
                <div>
                    <label class="eyebrow text-charcoal" for="name">{{ __('store.contact.name') }}</label>
                    <input id="name" name="name" value="{{ old('name') }}" class="field mt-2" required>
                    @error('name')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="eyebrow text-charcoal" for="email">{{ __('store.contact.email') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="field mt-2" required>
                        @error('email')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="eyebrow text-charcoal" for="phone">{{ __('store.contact.phone') }}</label>
                        <input id="phone" name="phone" value="{{ old('phone') }}" class="field mt-2">
                    </div>
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="subject">{{ __('store.contact.subject') }}</label>
                    <input id="subject" name="subject" value="{{ old('subject') }}" class="field mt-2" required>
                    @error('subject')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="message">{{ __('store.contact.message') }}</label>
                    <textarea id="message" name="message" class="field mt-2" required>{{ old('message') }}</textarea>
                    @error('message')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <button class="btn btn-ink btn-shine">{{ __('store.contact.send') }}</button>
            </div>
        </form>
    </section>
@endsection
