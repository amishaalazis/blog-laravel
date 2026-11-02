<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'categories'])->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['user', 'categories']);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'categories' => ['sometimes', 'array'],
            'categories.*' => ['integer', 'exists:categories,id'],
        ]);
        $categoryIds = $validated['categories'] ?? [];
        unset($validated['categories']);
        $post = $request->user()->posts()->create($validated);
        if (! empty($categoryIds)) {
            $post->categories()->sync($categoryIds);
        }

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post berhasil dibuat.');
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        $post->load(['user', 'categories']);
        $categories = Category::all();
        $selectedCategories = $post->categories->pluck('id')->all();

        return view('posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);
        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'content' => ['sometimes', 'required', 'string'],
            'categories' => ['sometimes', 'array'],
            'categories.*' => ['integer', 'exists:categories,id'],
        ]);
        if (array_key_exists('categories', $validated)) {
            $post->categories()->sync($validated['categories']);
            unset($validated['categories']);
        }
        $post->update($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil dihapus.');
    }
}
