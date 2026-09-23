@extends('layouts.admin')

@section('title', 'Notes')

@section('content')
    <p class="eyebrow text-mint-deep">Desk</p>
    <h1 class="mt-2 font-display text-5xl">Notes</h1>
    <div class="mt-8 space-y-3">
        @forelse ($inquiries as $inquiry)
            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="block rounded-[1.3rem] border border-line bg-paper px-5 py-4 {{ $inquiry->is_read ? '' : 'border-mint' }}">
                <div class="flex flex-col justify-between gap-1 sm:flex-row">
                    <p class="font-medium">{{ $inquiry->subject }}</p>
                    <p class="text-sm text-charcoal">{{ $inquiry->created_at->diffForHumans() }}</p>
                </div>
                <p class="mt-1 text-sm text-charcoal">{{ $inquiry->name }} · {{ $inquiry->email }}</p>
            </a>
        @empty
            <p class="text-charcoal">The desk is clear.</p>
        @endforelse
    </div>
    <div class="mt-6">{{ $inquiries->links() }}</div>
@endsection
