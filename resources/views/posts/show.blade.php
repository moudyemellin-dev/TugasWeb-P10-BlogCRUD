@extends('layouts.app')

@section('title', $post->title)

@section('content')

<x-card>

@if ($post->image)
    <img
        src="{{ asset('storage/' . $post->image) }}"
        class="w-full max-h-96 object-cover rounded-xl mb-6">
@endif

<h1 class="text-4xl font-bold mb-4">
    {{ $post->title }}
</h1>

<p class="text-slate-500 mb-6">
    Dibuat: {{ $post->created_at->format('d M Y H:i') }}
</p>

<div class="text-lg leading-8 whitespace-pre-line">
    {{ $post->content }}
</div>

<div class="mt-8">

    <a
        href="{{ route('posts.index') }}"
        class="bg-slate-700 text-white px-5 py-3 rounded-lg">
        Kembali
    </a>

</div>

</x-card>

@endsection