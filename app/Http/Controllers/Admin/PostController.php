<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Список всех постов (не только своих).
     */
    public function index()
    {
        $posts = Post::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'published' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();

        if (isset($validated['published']) && $validated['published']) {
            $validated['published_at'] = now();
        } else {
            $validated['published'] = false;
            $validated['published_at'] = null;
        }

        Post::create($validated);

        return redirect()->route('admin.posts')
                        ->with('success', __('Post created'));
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Админ может редактировать любой пост, без проверки владельца.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'published' => 'boolean',
        ]);

        if (isset($validated['published']) && $validated['published']) {
            if (!$post->published || !$post->published_at) {
                $validated['published_at'] = now();
            }
        } else {
            $validated['published'] = false;
            $validated['published_at'] = null;
        }

        $post->update($validated);

        return redirect()->route('admin.posts')
                        ->with('success', __('Post updated'));
    }

    /**
     * Админ может удалить любой пост.
     */
    public function delete(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts')
                        ->with('success', __('Post deleted'));
    }

    public function like(Request $request, Post $post)
    {
        $user = $request->user();

        if ($post->isLikedBy($user)) {
            $post->likedByUsers()->detach($user->id);
        } else {
            $post->likedByUsers()->syncWithoutDetaching([$user->id]);
        }

        return back()->with('success', __('Like updated'));
    }
}
