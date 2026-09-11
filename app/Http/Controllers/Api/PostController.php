<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Список опубликованных постов.
     */
    public function index(Request $request)
    {
        $posts = Post::query()
            ->where('published', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(10);

        return response()->json($posts);
    }

    /**
     * Один опубликованный пост.
     */
    public function show(Post $post)
    {
        if (! $post->isPublished()) {
            abort(404);
        }

        return response()->json($post);
    }

    /**
     * Создание поста текущим пользователем.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'published' => ['boolean'],
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['published'] = $validated['published'] ?? false;
        $validated['published_at'] = $validated['published'] ? now() : null;

        $post = Post::create($validated);

        return response()->json($post, 201);
    }

    /**
     * Обновление поста — только своего.
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'content' => ['sometimes', 'required', 'string'],
            'published' => ['boolean'],
        ]);

        if (array_key_exists('published', $validated)) {
            if ($validated['published'] && ! $post->isPublished()) {
                $validated['published_at'] = now();
            } elseif (! $validated['published']) {
                $validated['published_at'] = null;
            }
        }

        $post->update($validated);

        return response()->json($post);
    }

    /**
     * Удаление поста — только своего.
     */
    public function delete(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            abort(403);
        }

        $post->delete();

        return response()->json(null, 204);
    }

    /**
     * Переключение лайка от текущего пользователя (лайк/анлайк).
     */
    public function like(Request $request, Post $post)
    {
        $user = $request->user();

        if ($post->isLikedBy($user)) {
            $post->likedByUsers()->detach($user->id);
            $liked = false;
        } else {
            $post->likedByUsers()->syncWithoutDetaching([$user->id]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $post->likedByUsers()->count(),
        ]);
    }
}
