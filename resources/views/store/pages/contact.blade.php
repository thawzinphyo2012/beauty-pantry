@extends('layouts.store')

@section('title', 'Contact — Beauty Pantry')

@section('content')
    <section class="mx-auto grid max-w-7xl gap-12 px-4 pb-20 pt-10 sm:px-6 lg:grid-cols-2 lg:px-8">
        <div>
            <p class="eyebrow text-mint-deep">Atelier desk</p>
            <h1 class="mt-3 font-display text-6xl leading-[0.92] sm:text-7xl">Write to the pantry.</h1>
            <p class="mt-6 max-w-md text-base leading-8 text-charcoal">Shade advice, gifting, or a ritual that is not behaving. Notes arrive in the admin desk — we read every one.</p>
            <dl class="mt-10 space-y-4 text-sm">
                <div><dt class="eyebrow text-charcoal">Email</dt><dd class="mt-1">hello@beautypantry.com</dd></div>
                <div><dt class="eyebrow text-charcoal">City</dt><dd class="mt-1">Yangon, Myanmar</dd></div>
                <div><dt class="eyebrow text-charcoal">Hours</dt><dd class="mt-1">Tuesday to Sunday, 11:00 – 19:00</dd></div>
            </dl>
        </div>
        <form action="{{ route('contact.send') }}" method="POST" class="rounded-[1.8rem] border border-line bg-paper p-6 sm:p-8">
            @csrf
            <div class="grid gap-4">
                <div>
                    <label class="eyebrow text-charcoal" for="name">Name</label>
                    <input id="name" name="name" value="{{ old('name') }}" class="field mt-2" required>
                    @error('name')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="eyebrow text-charcoal" for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="field mt-2" required>
                        @error('email')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="eyebrow text-charcoal" for="phone">Phone</label>
                        <input id="phone" name="phone" value="{{ old('phone') }}" class="field mt-2">
                    </div>
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="subject">Subject</label>
                    <input id="subject" name="subject" value="{{ old('subject') }}" class="field mt-2" required>
                    @error('subject')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="eyebrow text-charcoal" for="message">Message</label>
                    <textarea id="message" name="message" class="field mt-2" required>{{ old('message') }}</textarea>
                    @error('message')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <button class="btn btn-ink">Send the note</button>
            </div>
        </form>
    </section>
@endsection
