@extends('layouts.store')

@section('title', 'Enter — Beauty Pantry')

@section('content')
    <section class="mx-auto max-w-md px-4 pb-24 pt-12">
        <p class="eyebrow text-mint-deep">Account</p>
        <h1 class="mt-3 font-display text-6xl leading-none">Enter.</h1>
        <form action="{{ route('login') }}" method="POST" class="mt-8 grid gap-4">
            @csrf
            <div>
                <label class="eyebrow text-charcoal" for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="field mt-2" required autofocus>
                @error('email')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="eyebrow text-charcoal" for="password">Password</label>
                <input id="password" type="password" name="password" class="field mt-2" required>
            </div>
            <label class="flex items-center gap-2 text-sm text-charcoal">
                <input type="checkbox" name="remember" value="1" class="accent-mint">
                Remember this browser
            </label>
            <button class="btn btn-ink">Continue</button>
        </form>
        <p class="mt-6 text-sm text-charcoal">New to the pantry? <a href="{{ route('register') }}" class="text-ink underline underline-offset-4">Create an account</a></p>
    </section>
@endsection
