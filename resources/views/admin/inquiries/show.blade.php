@extends('layouts.admin')

@section('title', $inquiry->subject)

@section('content')
    <a href="{{ route('admin.inquiries.index') }}" class="text-sm underline underline-offset-4">All notes</a>
    <h1 class="mt-4 font-display text-5xl">{{ $inquiry->subject }}</h1>
    <p class="mt-3 text-charcoal">{{ $inquiry->name }} · {{ $inquiry->email }} @if($inquiry->phone) · {{ $inquiry->phone }} @endif</p>
    <div class="mt-8 max-w-2xl rounded-[1.4rem] border border-line bg-paper p-6 leading-8">{{ $inquiry->message }}</div>
    <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="mt-6" onsubmit="return confirm('Remove this note?')">
        @csrf
        @method('DELETE')
        <button class="text-sm text-red-700 underline underline-offset-4">Delete note</button>
    </form>
@endsection
