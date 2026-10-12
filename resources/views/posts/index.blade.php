@extends('layouts.app')

@section('title', 'Daftar Post')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold">Daftar Post</h1>
        <p class="text-slate-500">Blog CRUD menggunakan Laravel</p>
    </div>

    <a href="{{ route('posts.create') }}"
       class="bg-emerald-700 text-white px-5 py-3 rounded-lg">
        + Tambah Post
    </a>
</div>

<form method="GET"
      action="{{ route('posts.index') }}"
      class="mb-6 flex gap-2">

    <input
        type="text"
        name="search"
        value="{{ $search }}"
        placeholder="Cari judul atau isi..."
        class="border rounded-lg px-4 py-3 w-full"
    >

    <button
        class="bg-slate-800 text-white px-6 rounded-lg">
        Cari
    </button>

    @if ($search)
        <a href="{{ route('posts.index') }}"
           class="bg-slate-300 px-5 py-3 rounded-lg">
            Reset
        </a>
    @endif
</form>

<div class="space-y-5">

@forelse ($posts as $post)

    <x-card>

        <div class="flex gap-6">

            @if ($post->image)
                <img
                    src="{{ asset('storage/' . $post->image) }}"
                    class="w-40 h-28 object-cover rounded-xl"
                    alt="{{ $post->title }}">
            @endif

            <div class="flex-1">

                <h2 class="text-2xl font-bold mb-2">
                    {{ $post->title }}
                </h2>

                <p class="text-slate-600 mb-4">
                    {{ Str::limit($post->content, 150) }}
                </p>

                <div class="flex gap-2">

                    <a href="{{ route('posts.show', $post) }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Detail
                    </a>

                    <a href="{{ route('posts.edit', $post) }}"
                       class="bg-amber-500 text-white px-4 py-2 rounded-lg">
                        Edit
                    </a>

                    <form
                        action="{{ route('posts.destroy', $post) }}"
                        method="POST"
                        onsubmit="return confirm('Pindahkan post ke trash?')">

                        @csrf
                        @method('DELETE')

                        <button
                            class="bg-red-600 text-white px-4 py-2 rounded-lg">
                            Hapus
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </x-card>

@empty

    <x-card>
        <p class="text-center text-slate-500">
            Belum ada post.
        </p>
    </x-card>

@endforelse

</div>

<div class="mt-8">
    {{ $posts->links() }}
</div>

@endsection