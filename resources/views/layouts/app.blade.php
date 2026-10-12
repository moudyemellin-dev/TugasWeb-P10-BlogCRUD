<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Blog CRUD')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-800">

<nav class="bg-emerald-700 text-white">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between">
        <a href="{{ route('posts.index') }}"
           class="font-bold text-xl">
            Blog Laravel
        </a>

        <div class="flex gap-5">
            <a href="{{ route('posts.index') }}">Home</a>
            <a href="{{ route('posts.create') }}">Tambah Post</a>
            <a href="{{ route('posts.trash') }}">Trash</a>
        </div>
    </div>
</nav>

<main class="max-w-6xl mx-auto px-6 py-10">

    <x-alert />

    @yield('content')

</main>

</body>
</html>