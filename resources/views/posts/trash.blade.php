@extends('layouts.app')

@section('title', 'Trash')

@section('content')

<h1 class="text-3xl font-bold mb-8">
    Trash
</h1>

<div class="space-y-4">

@forelse ($posts as $post)

<x-card>

    <h2 class="text-xl font-bold">
        {{ $post->title }}
    </h2>

    <p class="text-slate-500 mt-2">
        Dihapus:
        {{ $post->deleted_at->format('d M Y H:i') }}
    </p>

    <div class="flex gap-2 mt-5">

        <form
            action="{{ route('posts.restore', $post->id) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <button
                class="bg-emerald-700 text-white px-4 py-2 rounded-lg">
                Restore
            </button>

        </form>

        <form
            action="{{ route('posts.forceDelete', $post->id) }}"
            method="POST"
            onsubmit="return confirm('Hapus permanen?')">

            @csrf
            @method('DELETE')

            <button
                class="bg-red-700 text-white px-4 py-2 rounded-lg">
                Hapus Permanen
            </button>

        </form>

    </div>

</x-card>

@empty

<x-card>
    <p class="text-center">
        Trash kosong.
    </p>
</x-card>

@endforelse

</div>

<div class="mt-8">
    {{ $posts->links() }}
</div>

@endsection