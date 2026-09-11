<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'from_date' => ['nullable', 'date', 'max:50'],
            'to_date' => ['nullable', 'date', 'max:50', 'after:from_date'],
        ]);
         
        $query = Post::query()
            ->where('published', true)
            ->whereNotNull('published_at');

        if ($search = $validated['search'] ?? null) {
            $query->where('title', 'ilike', "%{$search}%");
        }
        if ($fromDate = $validated['from_date'] ?? null) {
            $query->where('published_at', '>=', new Carbon($fromDate));
        }
        if ($toDate = $validated['to_date'] ?? null) {
            $query->where('published_at', '<=', new Carbon($toDate));
        }

        $posts = $query->latest('published_at')
            ->paginate(12);

        $latestPosts = Post::query()
            ->where('published', true)
            ->whereNotNull('published_at')
            ->with('user')
            ->withCount('likedByUsers')
            ->latest('published_at')
            ->take(10)
            ->get();

        return view('blog.index', compact('posts', 'latestPosts'));
    }

    public function show(Request $request, Post $post)
    {   
        return view('blog.show', compact('post'));
    }

    /**
     * Переключение лайка от текущего пользователя (лайк/анлайк).
     */
    public function like(Request $request, Post $post)
    {
        $user = $request->user();

        if ($post->isLikedBy($user)) {
            $post->likedByUsers()->detach($user->id);
        } else {
            $post->likedByUsers()->syncWithoutDetaching([$user->id]);
        }

        return back();
    }
}
