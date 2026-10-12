<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $posts = Post::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('posts.index', compact('posts', 'search'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')
                    ->store('posts', 'public');
            }

            Post::create($validated);

            return redirect()
                ->route('posts.index')
                ->with('success', 'Post berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Post gagal ditambahkan.');
        }
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }

                $validated['image'] = $request->file('image')
                    ->store('posts', 'public');
            }

            $post->update($validated);

            return redirect()
                ->route('posts.index')
                ->with('success', 'Post berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Post gagal diperbarui.');
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();

            return redirect()
                ->route('posts.index')
                ->with('success', 'Post dipindahkan ke trash.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Post gagal dihapus.');
        }
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()
            ->latest('deleted_at')
            ->paginate(5);

        return view('posts.trash', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()
            ->route('posts.trash')
            ->with('success', 'Post berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->forceDelete();

        return redirect()
            ->route('posts.trash')
            ->with('success', 'Post dihapus permanen.');
    }
}