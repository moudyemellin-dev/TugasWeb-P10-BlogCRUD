@extends('layouts.app')

@section('title', 'Tambah Post')

@section('content')

<x-card>

<h1 class="text-3xl font-bold mb-6">
    Tambah Post
</h1>

<form
    action="{{ route('posts.store') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <div class="mb-5">

        <label class="font-semibold">
            Judul
        </label>

        <input
            type="text"
            name="title"
            value="{{ old('title') }}"
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
            class="w-full border rounded-lg px-4 py-3 mt-2">{{ old('content') }}</textarea>

        @error('content')
            <p class="text-red-600 mt-1">
                {{ $message }}
            </p>
        @enderror

    </div>

    <div class="mb-6">

        <label class="font-semibold">
            Gambar
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
        Simpan
    </button>

    <a
        href="{{ route('posts.index') }}"
        class="ml-2 bg-slate-300 px-6 py-3 rounded-lg">
        Batal
    </a>

</form>

</x-card>

@endsection