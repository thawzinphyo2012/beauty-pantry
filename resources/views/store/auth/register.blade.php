@extends('layouts.store')

@section('title', __('store.auth.register_title'))

@section('content')
    <section class="auth-shell screen-auth mx-auto max-w-md px-4 pb-24 pt-12">
        <div class="relative is-visible" data-reveal>
            <p class="anim-rise eyebrow text-mint-deep" style="--rise-delay: 40ms">{{ __('store.auth.account') }}</p>
            <h1 class="page-title text-3d mt-3 font-display leading-none" data-text-3d style="--text-delay: 80ms">{{ __('store.auth.join') }}</h1>
            <form action="{{ route('register') }}" method="POST" class="panel panel-glow anim-rise mt-8 grid gap-4 p-6 sm:p-8" style="--rise-delay: 360ms">
                @csrf
                <div>
                    <label class="eyebrow text-charcoal" for="name">{{ __('store.auth.name') }}</label>
                    <input id="name" name="name" value="{{ old('name') }}" class="field mt-2" required>
                    @error('name')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="email">{{ __('store.auth.email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="field mt-2" required>
                    @error('email')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="password">{{ __('store.auth.password') }}</label>
                    <input id="password" type="password" name="password" class="field mt-2" required>
                    @error('password')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="password_confirmation">{{ __('store.auth.confirm') }}</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="field mt-2" required>
                </div>
                <button class="btn btn-ink btn-shine">{{ __('store.auth.create') }}</button>
            </form>
            <p class="anim-rise mt-6 text-sm text-charcoal" style="--rise-delay: 480ms">{{ __('store.auth.have') }} <a href="{{ route('login') }}" class="text-ink underline underline-offset-4 transition hover:text-mint-deep">{{ __('store.auth.enter_link') }}</a></p>
        </div>
    </section>
@endsection
