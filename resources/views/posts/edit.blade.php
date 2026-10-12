@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<x-card>

<h1 class="text-3xl font-bold mb-6">
    Edit Post
</h1>

<form
    action="{{ route('posts.update', $post) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="mb-5">

        <label class="font-semibold">
            Judul
        </label>

        <input
            type="text"
            name="title"
            value="{{ old('title', $post->title) }}"
            class="w-full border rounded-lg px-4 py-3 mt-2">

        @error('title')
            <p class="text-red-600 mt-1">
                {{ $message }}
            </p>
        @enderror

    </div>

    <div class="mb-5">

        <label class="font-semibold">
            Konten
        </label>

        <textarea
            name="content"
            rows="7"
            class="w-full border rounded-lg px-4 py-3 mt-2">{{ old('content', $post->content) }}</textarea>

        @error('content')
            <p class="text-red-600 mt-1">
                {{ $message }}
            </p>
        @enderror

    </div>

    @if ($post->image)
        <img
            src="{{ asset('storage/' . $post->image) }}"
            class="w-48 rounded-xl mb-4">
    @endif

    <div class="mb-6">

        <label class="font-semibold">
            Ganti Gambar
        </label>

        <input
            type="file"
            name="image"
            class="block mt-2">

        @error('image')
            <p class="text-red-600 mt-1">
                {{ $message }}
            </p>
        @enderror

    </div>

    <button
        class="bg-emerald-700 text-white px-6 py-3 rounded-lg">
        Update
    </button>

</form>

</x-card>

@endsection