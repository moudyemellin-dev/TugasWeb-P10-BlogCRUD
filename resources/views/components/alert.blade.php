@if (session('success'))
    <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-xl">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-800 rounded-xl">
        {{ session('error') }}
    </div>
@endif
 