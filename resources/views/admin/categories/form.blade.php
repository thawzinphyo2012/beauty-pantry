@extends('layouts.admin')

@section('title', $category->exists ? 'Edit collection' : 'New collection')

@section('content')
    <h1 class="font-display text-5xl">{{ $category->exists ? 'Edit collection' : 'New collection' }}</h1>
    <form action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST" class="mt-8 grid max-w-xl gap-4">
        @csrf
        @if ($category->exists) @method('PUT') @endif
        <div>
            <label class="eyebrow text-charcoal" for="name">Name</label>
            <input id="name" name="name" value="{{ old('name', $category->name) }}" class="field mt-2" required>
            @error('name')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="eyebrow text-charcoal" for="eyebrow">Eyebrow</label>
            <input id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $category->eyebrow) }}" class="field mt-2">
        </div>
        <div>
            <label class="eyebrow text-charcoal" for="description">Description</label>
            <textarea id="description" name="description" class="field mt-2">{{ old('description', $category->description) }}</textarea>
        </div>
        <div>
            <label class="eyebrow text-charcoal" for="sort">Sort</label>
            <input id="sort" type="number" name="sort" value="{{ old('sort', $category->sort ?? 0) }}" class="field mt-2">
        </div>
        <button class="btn btn-ink">Save collection</button>
    </form>
    @if ($category->exists)
        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="mt-6" onsubmit="return confirm('Delete this collection?')">
            @csrf
            @method('DELETE')
            <button class="text-sm text-red-700 underline underline-offset-4">Delete collection</button>
        </form>
    @endif
@endsection
