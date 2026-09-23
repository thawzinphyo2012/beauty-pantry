@extends('layouts.store')

@section('title', 'Join — Beauty Pantry')

@section('content')
    <section class="mx-auto max-w-md px-4 pb-24 pt-12">
        <p class="eyebrow text-mint-deep">Account</p>
        <h1 class="mt-3 font-display text-6xl leading-none">Join.</h1>
        <form action="{{ route('register') }}" method="POST" class="mt-8 grid gap-4">
            @csrf
            <div>
                <label class="eyebrow text-charcoal" for="name">Name</label>
                <input id="name" name="name" value="{{ old('name') }}" class="field mt-2" required>
                @error('name')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="eyebrow text-charcoal" for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="field mt-2" required>
                @error('email')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="eyebrow text-charcoal" for="password">Password</label>
                <input id="password" type="password" name="password" class="field mt-2" required>
                @error('password')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="eyebrow text-charcoal" for="password_confirmation">Confirm</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="field mt-2" required>
            </div>
            <button class="btn btn-ink">Create account</button>
        </form>
        <p class="mt-6 text-sm text-charcoal">Already with us? <a href="{{ route('login') }}" class="text-ink underline underline-offset-4">Enter</a></p>
    </section>
@endsection
